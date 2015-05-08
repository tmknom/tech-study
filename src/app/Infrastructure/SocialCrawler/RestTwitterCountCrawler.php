<?php

namespace App\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Domain\SocialCrawler\TwitterCountCrawler;
use App\Library\Http\JsonHttpClient;

class RestTwitterCountCrawler implements TwitterCountCrawler
{

    /** @var string APIのURL */
    const URL = 'http://urls.api.twitter.com/1/urls/count.json?url=';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
    }

    /**
     * @param EventUrl $eventUrl
     * @return TwitterCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        $json = $this->jsonHttpClient->request(self::URL . $eventUrl->urlEncode());

        // TwitterAPIはたとえ存在しないURLであっても必ず"count"を含むJSONを返してくるので
        // 要素のチェックなど、異常系を考慮した実装は不要
        return new TwitterCount($json['count']);
    }

}
