<?php

namespace App\Library\Http;

interface HttpClient
{
    /**
     * HTTPリクエスト送信し、結果を文字列で取得する
     *
     * @param string $url
     * @return string
     */
    public function request($url);

}