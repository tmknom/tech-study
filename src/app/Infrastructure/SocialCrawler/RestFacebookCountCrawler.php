<?php

namespace App\Infrastructure\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Rating\FacebookCount;
use App\Domain\SocialCrawler\FacebookCountCrawler;
use App\Library\Http\JsonHttpClient;

class RestFacebookCountCrawler implements FacebookCountCrawler
{

    /** @var string APIのURL */
    const URL = 'http://graph.facebook.com/?id=';

    /** @var JsonHttpClient */
    private $jsonHttpClient;

    /** コンストラクタ */
    public function __construct(JsonHttpClient $jsonHttpClient)
    {
        $this->jsonHttpClient = $jsonHttpClient;
    }

    /**
     * @param EventUrl $eventUrl
     * @return FacebookCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        $json = $this->jsonHttpClient->request(self::URL . $eventUrl->urlEncode());

        // FacebookAPIは、一度もイイネされてない、URLに対しては、イイネ数のキー"shares"自体を返さない
        // なので、まずはキーが存在するかチェックする必要がある
        $count = 0;
        if (array_key_exists('shares', $json)) {
            $count = $json["shares"];
        }

        return new FacebookCount($count);
    }

}
