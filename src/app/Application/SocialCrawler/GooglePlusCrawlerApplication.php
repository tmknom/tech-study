<?php

namespace App\Application\SocialCrawler;

use App\Domain\Rating\Repository\GooglePlusRatingRepository;
use App\Domain\SocialCrawler\GooglePlusCountCrawler;

class GooglePlusCrawlerApplication implements SocialCrawlerApplication
{

    use TransactionSocialCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param GooglePlusCountCrawler $socialCrawler
     * @param GooglePlusRatingRepository $ratingRepository
     */
    public function __construct(GooglePlusCountCrawler $socialCrawler, GooglePlusRatingRepository $ratingRepository)
    {
        $this->construct($socialCrawler, $ratingRepository);
    }

}
