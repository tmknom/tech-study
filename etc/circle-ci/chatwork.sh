#!/bin/bash

# ビルド成功時は develop ブランチのみ通知
#if [ ${CIRCLECI} -eq 0 ] && [ ${CIRCLE_BRANCH} != "master" ]; then
#  echo "exit: build success on any branch without master"
#  exit 0
#fi

if [ `cat $CIRCLE_ARTIFACTS/logs/junit.json | grep '"status": "fail"'`} ]; then
  result="BUILD SUCCESS (cracker)"
  emotion="(cracker)"
else
  result="BUILD FAILED (devil)"
  emotion="(devil)"
fi

body="[info][title]${result} - ${CIRCLE_PROJECT_REPONAME}/${CIRCLE_BRANCH} [/title]commit: ${CIRCLE_COMPARE_URL}/
build: https://circleci.com/gh/${CIRCLE_PROJECT_USERNAME}/${CIRCLE_PROJECT_REPONAME}/${CIRCLE_BUILD_NUM}[/info]"
echo "$body"
echo ""

script="puts URI.encode_www_form_component('${body}')"
encoded=`ruby -r uri -e "${script}"`
echo $encoded

curl -X POST -H "X-ChatWorkToken:$CHATWORK_TOKEN" -d body=${encoded} "https://api.chatwork.com/v1/rooms/$CHATWORK_ROOM_ID/messages"
