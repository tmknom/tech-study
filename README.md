# tech-study

[![Build Status](https://travis-ci.org/tmknom/tech-study.svg?branch=master)](https://travis-ci.org/tmknom/tech-study)
[![Coverage Status](https://coveralls.io/repos/tmknom/tech-study/badge.svg?branch=feature%2Fsetup-coveralls)](https://coveralls.io/r/tmknom/tech-study?branch=feature%2Fsetup-coveralls)

## 実行方法

### Vagrantの環境構築

```bash
$ vagrant up
$ fab -H 192.168.0.10 -u vagrant -p vagrant -f etc/fabric/fabfile.py setup
```
