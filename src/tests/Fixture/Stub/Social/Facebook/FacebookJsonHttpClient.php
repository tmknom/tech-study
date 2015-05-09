<?php

namespace Tests\Fixture\Stub\Social\Facebook;

use App\Library\Http\JsonHttpClient;

class FacebookJsonHttpClient implements JsonHttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Social/Facebook/test.json';

    public function request($url)
    {
        return json_decode(file_get_contents(base_path() . self::FIXTURE_PATH), true);
    }

}
