<?php

namespace App\Application\SocialCrawler;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount;
use App\Domain\Rating\RatingRepository;
use App\Domain\SocialCrawler\SocialCrawler;
use DB;

trait TransactionSocialCrawlerApplication
{

    /**  @var SocialCrawler */
    private $socialCrawler;

    /**  @var RatingRepository */
    private $ratingRepository;

    /**  @var RatingCount */
    private $updatedCount;

    /**
     * コンストラクタ
     *
     * @param SocialCrawler $socialCrawler
     * @param RatingRepository $ratingRepository
     */
    public function construct(SocialCrawler $socialCrawler, RatingRepository $ratingRepository)
    {
        $this->socialCrawler = $socialCrawler;
        $this->ratingRepository = $ratingRepository;
        $this->updatedCount = null;
    }

    /**
     * @param EventUrl $eventUrl
     * @return RatingCount
     */
    public function crawl(EventUrl $eventUrl)
    {
        DB::transaction(function () use ($eventUrl) {
            // ソーシャルカウント取得
            $this->updatedCount = $this->socialCrawler->crawl($eventUrl);
            // DB更新
            $this->ratingRepository->save($eventUrl, $this->updatedCount);
        });
        return $this->updatedCount;
    }

}
