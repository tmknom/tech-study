# tech-study

[![Build Status](https://travis-ci.org/tmknom/tech-study.svg?branch=master)](https://travis-ci.org/tmknom/tech-study)
[![Coverage Status](https://coveralls.io/repos/tmknom/tech-study/badge.svg?branch=feature%2Fsetup-coveralls)](https://coveralls.io/r/tmknom/tech-study?branch=feature%2Fsetup-coveralls)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tmknom/tech-study/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tmknom/tech-study/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a157cee3-2b5b-4d0a-bab4-376d7903871c/mini.png)](https://insight.sensiolabs.com/projects/a157cee3-2b5b-4d0a-bab4-376d7903871c)
[![Dependency Status](https://www.versioneye.com/user/projects/54d765012bc7901e48000002/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54d765012bc7901e48000002)


## 実行方法

### Vagrantの環境構築

```bash
$ vagrant up
$ fab -H 192.168.0.10 -u vagrant -p vagrant -f etc/fabric/fabfile.py setup
```
