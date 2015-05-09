<?php

namespace Tests\Fixture\Stub\Social\Twitter;

use App\Library\Http\JsonHttpClient;

class TwitterJsonHttpClient implements JsonHttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Social/Twitter/test.json';

    public function request($url)
    {
        return json_decode(file_get_contents(base_path() . self::FIXTURE_PATH), true);
    }

}
