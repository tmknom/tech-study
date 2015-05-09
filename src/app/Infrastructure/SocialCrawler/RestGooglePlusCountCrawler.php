<?php

namespace App\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\SocialCrawler\GooglePlusCountCrawler;
use App\Library\Http\HttpClient;

class RestGooglePlusCountCrawler implements GooglePlusCountCrawler
{

    /** @var string APIのURL */
    const URL = 'https://apis.google.com/_/+1/fastbutton?url=';

    /** @var HttpClient */
    private $httpClient;

    /** コンストラクタ */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param EventUrl $eventUrl
     * @return GooglePlusCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        $response = $this->httpClient->request(self::URL . $eventUrl->urlEncode());
        return new GooglePlusCount($this->getCount($response));
    }

    /**
     * @param string $response
     * @return int
     */
    private function getCount($response)
    {
        // GooglePlusAPIはボタン表示のJSを解析して、+1数を取得する
        // ld:[,[2,<count>,[ という記述からcountを抜き出す
        preg_match('/ld:\[,\[2,([0-9.]+),\[/', $response, $matches);
        return $matches[1];
    }

}
