# -*- encoding:utf-8 -*-
#
# CentOS6.5にLaravel5の実行環境を構築するFabricスクリプト
#
#####################################################################

from fabric.api import env, run, sudo, put
from fabric.colors import green
from fabric.decorators import task
from fabric.contrib.files import upload_template, exists

import time
import random
import string

########  基本設定  ########

# MySQLのデータベース名
MYSQL_DATABASE = 'app_db'
# MySQLのユーザ名
MYSQL_USER_NAME = 'app_user'
# MySQLのユーザパスワード
MYSQL_USER_PASSWORD  = 'password'
# MySQLのルートパスワード
MYSQL_ROOT_PASSWORD  = 'root_password'

# Laravelの環境設定
LARAVEL_APP_ENV = 'local'
# Laravelのデバッグフラグ
LARAVEL_APP_DEBUG = 'true'

# プロジェクトルート
PROJECT_ROOT = '/vagrant'
# Apacheのドキュメントルート
APACHE_DOCUMENT_ROOT = PROJECT_ROOT + '/src/public'
# Laravelのstorageディレクトリのパス
LARAVEL_STORAGE_PATH = PROJECT_ROOT + '/src/storage'


########  デコレータの定義  ########

# 実行時間を計測して標準出力するデコレータ
def measure_time(func):
  def _measure_time(*args, **keyword):
    start_time = time.time()
    task_name = " ".join(func.__name__.split("_"))
    print green('Start %s ...' % (task_name))
    func(*args, **keyword)
    end_time = time.time() - start_time
    print green('End %s : %s sec' % (task_name, end_time))
  return _measure_time


########  タスクの定義  ########

# サーバのセットアップ
@task
def setup():
  @measure_time
  def server_web_setup():
    add_repository()
    insatll_base_tools()
    install_php()
    install_composer()
    install_httpd()
    install_mysql()
    initialize_mysql()
    install_beanstalkd()
    link_document_root()
    setup_laravel()

  server_web_setup()



########  タスクから呼ばれるメソッドの定義  ########

@measure_time
def add_repository():
  add_epel_repository()
  add_remi_repository()

def add_epel_repository():
  sudo('rpm --import http://dl.fedoraproject.org/pub/epel/RPM-GPG-KEY-EPEL-6')
  sudo('rpm -ivh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm', warn_only=True)

def add_remi_repository():
  sudo('rpm --import http://rpms.famillecollet.com/RPM-GPG-KEY-remi')
  sudo('rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm', warn_only=True)


@measure_time
def insatll_base_tools():
  sudo('yum -y update')
  sudo('yum -y install wget')


@measure_time
def install_php():
  sudo('yum -y install --enablerepo=remi-php56 httpd php php-mbstring php-mysqlnd php-mcrypt php-xml php-opcache php-devephp')


@measure_time
def install_composer():
  sudo('curl -s https://getcomposer.org/installer | php')
  sudo('mv composer.phar /usr/local/bin/composer')


@measure_time
def install_httpd():
  sudo('cp -p /etc/httpd/conf/httpd.conf /etc/httpd/conf/httpd.conf.org')
  # HTTPレスポンスからサーバ情報隠蔽
  sudo("sed -i 's/^ServerTokens\s\+OS$/ServerTokens ProductOnly/' /etc/httpd/conf/httpd.conf")
  # フッタからサーバ情報隠蔽
  sudo("sed -i 's/^ServerSignature\s\+On$/ServerSignature Off/' /etc/httpd/conf/httpd.conf")
  # Indexesを削除して、ファイルが一覧されるのを防止
  sudo("sed -i 's/Options\s\+Indexes/Options -Indexes/' /etc/httpd/conf/httpd.conf")
  # URLエンコードでスラッシュを許可
  sudo("echo 'AllowEncodedSlashes On' >> /etc/httpd/conf/httpd.conf")

  sudo('chkconfig httpd on')
  sudo('service httpd start')


@measure_time
def install_mysql():
  sudo('rpm -i http://dev.mysql.com/get/mysql-community-release-el6-5.noarch.rpm')
  sudo('yum install -y mysql mysql-devel mysql-server mysql-utilities')
  sudo('cp -p /etc/my.cnf /etc/my.cnf.org')

  upload_template('etc/fabric/template/mysql/my.cnf',
                  '/etc/my.cnf',
                  context={
                            'charset' : 'utf8mb4',
                            'collation' : 'utf8mb4_general_ci',
                  },
                  use_sudo=True,
                  backup=False)

  sudo('chkconfig mysqld on')
  sudo('service mysqld start')


@measure_time
def initialize_mysql(database=MYSQL_DATABASE, user_name=MYSQL_USER_NAME, user_password=MYSQL_USER_PASSWORD, root_password=MYSQL_ROOT_PASSWORD):
  sudo('mysqladmin -u root password "%s"' % (root_password) )
  sudo('mysql -u root -p%s -e "GRANT ALL PRIVILEGES ON *.* TO %s@localhost IDENTIFIED BY \'%s\' WITH GRANT OPTION;FLUSH PRIVILEGES;"' % (root_password, user_name, user_password))
  sudo('mysql -u %s -p%s -e "CREATE DATABASE %s CHARACTER SET utf8mb4;"' % (user_name, user_password, database) )


@measure_time
def install_beanstalkd():
  sudo('yum install -y beanstalkd')
  sudo('chkconfig beanstalkd on')
  sudo('service beanstalkd start')


@measure_time
def link_document_root(document_root=APACHE_DOCUMENT_ROOT):
  sudo('rm -rf /var/www/html')
  sudo('ln -fs %s /var/www/html' % (document_root))


@measure_time
def setup_laravel():
  change_owner_laravel_storage_directory()
  create_laravel_env()

def change_owner_laravel_storage_directory(storage_path=LARAVEL_STORAGE_PATH):
  sudo('chown -R apache:apache %s' % (storage_path))

def create_laravel_env(app_env=LARAVEL_APP_ENV, app_debug=LARAVEL_APP_DEBUG,
                       database=MYSQL_DATABASE, user_name=MYSQL_USER_NAME, user_password=MYSQL_USER_PASSWORD):

  env_file_path = PROJECT_ROOT + '/src/.env'

  if not exists(env_file_path):
    # アプリケーションキーとしてランダム文字列を生成
    app_key = ''.join([random.choice(string.digits + string.letters) for i in range(32)])
    # .envファイルの生成
    upload_template('etc/fabric/template/laravel/env',
                    env_file_path,
                    context={
                      'app_env' : app_env,
                      'app_debug' : app_debug,
                      'app_key' : app_key,
                      'db_database' : database,
                      'db_user_name' : user_name,
                      'db_password' : user_password,
                    },
                    use_sudo=True,
                    backup=False)

