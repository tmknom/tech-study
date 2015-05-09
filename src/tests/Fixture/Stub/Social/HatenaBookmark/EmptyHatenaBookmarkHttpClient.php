<?php

namespace Tests\Fixture\Stub\Social\HatenaBookmark;

use App\Library\Http\HttpClient;

class EmptyHatenaBookmarkHttpClient implements HttpClient
{

    const FIXTURE_PATH = '/tests/Fixture/Response/Social/HatenaBookmark/empty.txt';

    public function request($url)
    {
        return file_get_contents(base_path() . self::FIXTURE_PATH);
    }

}
