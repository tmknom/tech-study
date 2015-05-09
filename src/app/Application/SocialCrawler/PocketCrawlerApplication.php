<?php

namespace App\Application\SocialCrawler;

use App\Domain\Rating\Repository\PocketRatingRepository;
use App\Domain\SocialCrawler\PocketCountCrawler;

class PocketCrawlerApplication implements SocialCrawlerApplication
{

    use TransactionSocialCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param PocketCountCrawler $socialCrawler
     * @param PocketRatingRepository $ratingRepository
     */
    public function __construct(PocketCountCrawler $socialCrawler, PocketRatingRepository $ratingRepository)
    {
        $this->construct($socialCrawler, $ratingRepository);
    }

}
