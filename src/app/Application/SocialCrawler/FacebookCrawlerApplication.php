<?php

namespace App\Application\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\EventRepository;
use App\Domain\Event\Rating\FacebookCount;
use App\Domain\SocialCrawler\FacebookCountCrawler;
use DB;

class FacebookCrawlerApplication
{

    /**  @var FacebookCountCrawler */
    private $ratingCountCrawler;

    /**  @var EventRepository */
    private $eventRepository;

    /**  @var FacebookCount */
    private $updatedCount;

    /** コンストラクタ */
    public function __construct(FacebookCountCrawler $ratingCountCrawler, EventRepository $eventRepository)
    {
        $this->ratingCountCrawler = $ratingCountCrawler;
        $this->eventRepository = $eventRepository;
        $this->updatedCount = null;
    }

    /**
     * @param EventUrl $eventUrl
     * @return FacebookCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        DB::transaction(function () use ($eventUrl) {
            // ソーシャルカウント取得
            $this->updatedCount = $this->ratingCountCrawler->crawl($eventUrl);
            // DB更新
            $this->eventRepository->saveFacebookCount($eventUrl, $this->updatedCount);
        });
        return $this->updatedCount;
    }

}
