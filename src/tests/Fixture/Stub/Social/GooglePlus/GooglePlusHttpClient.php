<?php

namespace Tests\Fixture\Stub\Social\GooglePlus;

use App\Library\Http\HttpClient;

class GooglePlusHttpClient implements HttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Social/GooglePlus/test.html';

    public function request($url)
    {
        return file_get_contents(base_path() . self::FIXTURE_PATH);
    }

}
