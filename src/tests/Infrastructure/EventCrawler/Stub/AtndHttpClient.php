<?php

namespace Tests\Infrastructure\EventCrawler\Stub;

use App\Library\Http\JsonHttpClient;

class AtndHttpClient implements JsonHttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Atnd/test.json';

    public function request($url)
    {
        return json_decode(file_get_contents(base_path() . self::FIXTURE_PATH), true);
    }

}
