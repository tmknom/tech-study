<?php

namespace App\Application\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\EventRepository;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Domain\SocialCrawler\TwitterCountCrawler;
use DB;

class TwitterCrawlerApplication
{

    /**  @var TwitterCountCrawler */
    private $twitterCountCrawler;

    /**  @var EventRepository */
    private $eventRepository;

    /**  @var TwitterCount */
    private $updatedCount;

    /** コンストラクタ */
    public function __construct(TwitterCountCrawler $twitterCountCrawler, EventRepository $eventRepository)
    {
        $this->twitterCountCrawler = $twitterCountCrawler;
        $this->eventRepository = $eventRepository;
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
            $this->eventRepository->saveTwitterCount($eventUrl, $this->updatedCount);
        });
        return $this->updatedCount;
    }

}
