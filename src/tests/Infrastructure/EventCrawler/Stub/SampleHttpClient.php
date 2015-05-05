<?php

namespace Tests\Infrastructure\EventCrawler\Stub;

use App\Library\Http\HttpClient;

class SampleHttpClient implements HttpClient
{
    const FIXTURE_PATH = '/tests/Fixture/Response/Atnd/test.json';

    public function request($url)
    {
        return file_get_contents(base_path() . self::FIXTURE_PATH);
    }

}
