# tech-study

[![Circle CI](https://circleci.com/gh/tmknom/tech-study.svg?style=svg)](https://circleci.com/gh/tmknom/tech-study)
[![Coverage Status](https://coveralls.io/repos/tmknom/tech-study/badge.svg?branch=master)](https://coveralls.io/r/tmknom/tech-study?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tmknom/tech-study/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tmknom/tech-study/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a157cee3-2b5b-4d0a-bab4-376d7903871c/mini.png)](https://insight.sensiolabs.com/projects/a157cee3-2b5b-4d0a-bab4-376d7903871c)
[![Dependency Status](https://www.versioneye.com/user/projects/54d765012bc7901e48000002/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54d765012bc7901e48000002)
<!--[![Build Status](https://travis-ci.org/tmknom/tech-study.svg?branch=master)](https://travis-ci.org/tmknom/tech-study)-->


## 実行方法

### Vagrantの環境構築

```bash
$ vagrant up
$ fab setup -H 192.168.0.10 -u vagrant -p vagrant -f etc/configuration/fabfile.py
```

### ライブラリのインストール

```bash
$ cd src && composer install --prefer-source --no-interaction
```

### ライブラリのアップデート

```bash
$ composer self-update
$ cd src && composer update --prefer-source --no-interaction
```

### テスト実行方法

```bash
$ src/vendor/bin/phpunit
```

### DBマイグレーション＆初期化

```bash
$ cd src
$ php artisan migrate
$ php artisan migrate:reset
```
