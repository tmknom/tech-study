<?php

namespace App\Application\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Rating\TwitterCount;
use App\Domain\SocialCrawler\TwitterCountCrawler;
use DB;

class TwitterCrawlerApplication
{

    /**  @var TwitterCountCrawler */
    private $twitterCountCrawler;

    /**  @var EventRatingRepository */
//    private $eventRatingRepository;

    /**  @var TwitterCount */
    private $updatedCount;

    /** コンストラクタ */
    //function __construct(TwitterCountCrawler $twitterCountCrawler, EventRatingRepository $eventRatingRepository)
    function __construct(TwitterCountCrawler $twitterCountCrawler)
    {
        $this->twitterCountCrawler = $twitterCountCrawler;
//        $this->eventRatingRepository = $eventRatingRepository;
        $this->updatedCount = null;
    }

    /**
     * @param EventUrl $eventUrl
     * @return TwitterCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        DB::transaction(function () use ($eventUrl) {
            // ソーシャルカウント取得
            $this->updatedCount = $this->twitterCountCrawler->crawl($eventUrl);
            // DB更新
//            $this->eventRatingRepository->updateTwitterCount($eventUrl, $this->updatedCount);
        });
        return $this->updatedCount;
    }

}
