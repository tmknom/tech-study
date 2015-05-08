<?php

namespace App\Application\SocialCrawler;

use App\Domain\Rating\Repository\TwitterRatingRepository;
use App\Domain\SocialCrawler\TwitterCountCrawler;

class TwitterCrawlerApplication implements SocialCrawlerApplication
{

    use TransactionSocialCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param TwitterCountCrawler $socialCrawler
     * @param TwitterRatingRepository $ratingRepository
     */
    public function __construct(TwitterCountCrawler $socialCrawler, TwitterRatingRepository $ratingRepository)
    {
        $this->construct($socialCrawler, $ratingRepository);
    }

}
