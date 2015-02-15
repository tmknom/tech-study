# -*- encoding:utf-8 -*-
#
# デプロイ用のFabricスクリプト
#
# ＜使用方法＞
# ・本番環境
#   $ fab production deploy
# ・ステージング環境
#   $ fab staging deploy
#
# ＜ディレクトリ構造＞
# .
# |-- production
# |   |-- .env
# |   |-- current -> /path/to/production/releases/20151011_000001_000101
# |   `-- releases
# |       |-- 20151011_000000_000100
# |       `-- 20151011_000001_000101
# |-- staging
# |   |-- .env
# |   |-- current -> /path/to/staging/releases/20151001_000001_000011
# |   `-- releases
# |       |-- 20151001_000000_000010
# |       `-- 20151001_000001_000011
# `-- tmp
#     `-- 20151011_000001_000101.tar.gz
#
#####################################################################

from fabric.api import env, local, run, sudo, put, get, cd, lcd
from fabric.colors import green
from fabric.decorators import task
from fabric.contrib.files import upload_template, exists

import sys
import os
from datetime import datetime


########  基本設定  ########

# デプロイ名
DEPLOY_NAME = datetime.now().strftime("%Y%m%d_%H%M%S") + "_" + os.getenv("CIRCLE_BUILD_NUM").zfill(6)

# 保持するリリース履歴の件数
RELEASES_HISTORY_COUNT = 30


########  ディレクトリ設定  ########

# ベースディレクトリ
BASE_DIR = "~/"

# リリース先ディレクトリ名
RELEASES_DIR_NAME = "releases"

# 最新ディレクトリ名
CURRENT_DIR_NAME = "current"

# 一時ディレクトリ名
TMP_DIR_NAME = "tmp"

# 一時ディレクトリ：tarファイルなどの一時保管場所
TMP_DIR = BASE_DIR + TMP_DIR_NAME


########  特殊ファイル  ########

# デプロイファイルのtarボール名
TAR_BALL = DEPLOY_NAME + ".tar.gz"

# .envファイル名
DOT_ENV_FILE = ".env"

# デプロイ履歴ログ
DEPLOY_HISTORY_LOG = "deploy_history.log"

# 削除したリリース履歴ログ
DELETED_RELEASE_HISTORY_LOG = "deleted_release_history.log"


########  環境設定  ########

# 本番環境
PRODUCTION_ENVIRONMENT = "production"

# ステージング環境
STAGING_ENVIRONMENT = "staging"

# 環境設定が未定義：このディレクトリができている時はデプロイスクリプトにバグがある
NOT_INITIALIZED_ENVIRONMENT = "not_initialized"

# デプロイ先：タスクで切り替える想定
env.deploy_target = NOT_INITIALIZED_ENVIRONMENT


########  タスクの定義  ########

@task
def deploy():
  init()
  verify_initialized()
  clear_cache()
  delete_require_dev_package()
  create_tar_ball()
  sftp_tar_ball()
  extract_tar_ball()
  setup_laravel()
  change_current_symlink()
  delete_old_release_file()
  delete_tmp_file()
  log_deploy_history()
  teardown()


@task
def production():
  env.deploy_target = PRODUCTION_ENVIRONMENT
  initialize_env_dir(env.deploy_target)


@task
def staging():
  env.deploy_target = STAGING_ENVIRONMENT
  initialize_env_dir(env.deploy_target)


########  タスクから呼ばれるメソッドの定義  ########

def initialize_env_dir(deploy_target):
  # リリース先ディレクトリパス
  env.release_dir = BASE_DIR + deploy_target + "/" + RELEASES_DIR_NAME
  # 最新ディレクトリパス
  env.current_dir = BASE_DIR + deploy_target + "/" + CURRENT_DIR_NAME
  # .envファイルパス
  env.dot_env_file = BASE_DIR + deploy_target + "/" + DOT_ENV_FILE


def init():
  print green("Start deploy %s ..." % (env.deploy_target))


def verify_initialized():
  if env.deploy_target == NOT_INITIALIZED_ENVIRONMENT:
    sys.stderr.write("実行環境の指定が足りないぜ、坊や。\n'$ fab production deploy' or '$ fab staging deploy'")
    sys.exit(1)


def clear_cache():
  with lcd('src'):
    local("pwd")
    local("php artisan clear-compiled")
    local("php artisan cache:clear")
    local("php artisan route:clear")
    local("php artisan config:clear")


# require-devのパッケージを削除／本番環境で実行するかは要検討
def delete_require_dev_package():
  with lcd('src'):
    local("composer update --no-dev")


def create_tar_ball(tar_ball = TAR_BALL):
  local("tar cvfz %s --exclude-vcs --exclude '.env' --exclude 'build' src" % (tar_ball)) #  --exclude 'tests/*' --exclude 'Tests/*'


def sftp_tar_ball(tar_ball = TAR_BALL, tmp_dir = TMP_DIR):
  run("mkdir -p %s" % (tmp_dir))
  put(tar_ball, tmp_dir)


def extract_tar_ball(tar_ball = TAR_BALL, tmp_dir = TMP_DIR, deploy_name = DEPLOY_NAME):
  run("mkdir -p %s" % (env.release_dir))
  run("tar xvfz %s/%s -C %s" % (tmp_dir, tar_ball, env.release_dir))
  run("mv %s/src %s/%s" % (env.release_dir, env.release_dir, deploy_name))


def setup_laravel(deploy_name = DEPLOY_NAME):
  # storageディレクトリはApacheが触るのでアクセス権を付与
  run("chmod -R 777 %s/%s/storage" % (env.release_dir, deploy_name))
  # .envファイルをコピー：.envファイルは事前に各環境ごとに作成しておくことを想定
  run("cp -p %s %s/%s/%s" % (env.dot_env_file, env.release_dir, deploy_name, DOT_ENV_FILE))
  # オートローディングの最適化
  with cd(env.release_dir + "/" + deploy_name):
    run("php artisan clear-compiled")
    run("composer dump-autoload")
    run("php artisan optimize")


def change_current_symlink(deploy_name = DEPLOY_NAME):
  run("ln -snf %s/%s %s" % (env.release_dir, deploy_name, env.current_dir))


def delete_old_release_file(release_history_count = RELEASES_HISTORY_COUNT):
  # 最小履歴保持件数：事故防止の為、念のためメソッド内に定義している
  MIN_RELEASES_HISTORY_COUNT = 5

  if release_history_count > MIN_RELEASES_HISTORY_COUNT:
    deleted_release_history_log_file = TMP_DIR + "/" + DELETED_RELEASE_HISTORY_LOG
    run("ls -1 %s | sort | head -n -%s | tee %s" % (env.release_dir, release_history_count, deleted_release_history_log_file))
    get(deleted_release_history_log_file, os.getenv("CIRCLE_ARTIFACTS") + "/logs/" + DELETED_RELEASE_HISTORY_LOG)
    run("xargs -I{} -a %s --no-run-if-empty rm -rf %s/{}" % (deleted_release_history_log_file, env.release_dir))
  else:
    sys.stderr.write("それは攻めすぎだぜ、ブラザー。最低でも%s個は履歴を残してくれよな！" % (MIN_RELEASES_HISTORY_COUNT))
    sys.exit(1)


def delete_tmp_file():
  run("rm -rf %s/*" % (TMP_DIR))


def log_deploy_history(deploy_name = DEPLOY_NAME):
  run("echo '%s' >> %s/%s" % (deploy_name, env.deploy_target, DEPLOY_HISTORY_LOG))


def teardown():
  run("ls -alh %s" % (env.current_dir))
  print green("End deploy %s ..." % (env.deploy_target))
