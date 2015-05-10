<?php

namespace App\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\SocialCrawler\PocketCountCrawler;
use App\Library\Http\HttpClient;

class RestPocketCountCrawler implements PocketCountCrawler
{

    /** @var string APIのURL */
    const URL = 'http://widgets.getpocket.com/v1/button?v=1&count=horizontal&url=';

    /** @var HttpClient */
    private $httpClient;

    /** コンストラクタ */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param EventUrl $eventUrl
     * @return PocketCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        $response = $this->httpClient->request(self::URL . $eventUrl->urlEncode());
        return new PocketCount($this->getCount($response));
    }

    /**
     * @param string $response
     * @return int
     */
    private function getCount($response)
    {
        // PocketAPIはボタン表示のJSを解析して、あとで読む数を取得する
        // <em id="cnt">count</em> という記述からcountを抜き出す
        $matches = array(0, 0);
        preg_match('/<em id="cnt">([0-9.]+)<\/em>/', $response, $matches);
        return $matches[1];
    }

}
