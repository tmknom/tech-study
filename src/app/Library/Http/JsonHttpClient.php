<?php

namespace App\Library\Http;

interface JsonHttpClient
{

    /**
     * HTTPリクエスト送信し、結果をJSON配列で取得する
     *
     * @param string $url
     * @return array
     */
    public function request($url);

}
