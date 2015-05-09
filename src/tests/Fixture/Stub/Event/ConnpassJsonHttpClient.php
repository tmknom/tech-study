<?php

namespace Tests\Fixture\Stub\Event;

use App\Library\Http\JsonHttpClient;

class ConnpassJsonHttpClient implements JsonHttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Event/Connpass/test.json';

    public function request($url)
    {
        return json_decode(file_get_contents(base_path() . self::FIXTURE_PATH), true);
    }

}
