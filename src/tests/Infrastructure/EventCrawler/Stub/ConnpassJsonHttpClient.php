<?php

namespace Tests\Infrastructure\EventCrawler\Stub;

use App\Library\Http\JsonHttpClient;

class ConnpassJsonHttpClient implements JsonHttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Connpass/test.json';

    public function request($url)
    {
        return json_decode(file_get_contents(base_path() . self::FIXTURE_PATH), true);
    }

}
