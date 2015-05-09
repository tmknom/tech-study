<?php

namespace Tests\Fixture\Stub\Social\Pocket;

use App\Library\Http\HttpClient;

class PocketHttpClient implements HttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Social/Pocket/test.html';

    public function request($url)
    {
        return file_get_contents(base_path() . self::FIXTURE_PATH);
    }

}
