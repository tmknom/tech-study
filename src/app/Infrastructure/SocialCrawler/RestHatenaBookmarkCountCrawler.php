<?php

namespace App\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\SocialCrawler\HatenaBookmarkCountCrawler;
use App\Library\Http\HttpClient;

class RestHatenaBookmarkCountCrawler implements HatenaBookmarkCountCrawler
{

    /** @var string APIのURL */
    const URL = 'http://api.b.st-hatena.com/entry.count?url=';

    /** @var HttpClient */
    private $httpClient;

    /** コンストラクタ */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param EventUrl $eventUrl
     * @return HatenaBookmarkCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        $response = $this->httpClient->request(self::URL . $eventUrl->urlEncode());
        return new HatenaBookmarkCount($this->getCount($response));
    }

    /**
     * @param string $response
     * @return int
     */
    private function getCount($response)
    {
        // はてブされてない場合、空文字で返ってくるのでその対策
        if ($response === '') {
            return 0;
        }
        return $response;
    }

}
