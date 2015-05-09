<?php

namespace App\Application\SocialCrawler;

use App\Domain\Rating\Repository\FacebookRatingRepository;
use App\Domain\SocialCrawler\FacebookCountCrawler;

class FacebookCrawlerApplication
{

    use TransactionSocialCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param FacebookCountCrawler $socialCrawler
     * @param FacebookRatingRepository $ratingRepository
     */
    public function __construct(FacebookCountCrawler $socialCrawler, FacebookRatingRepository $ratingRepository)
    {
        $this->construct($socialCrawler, $ratingRepository);
    }

}
