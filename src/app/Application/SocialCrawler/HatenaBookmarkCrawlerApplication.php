<?php

namespace App\Application\SocialCrawler;

use App\Domain\Rating\Repository\HatenaBookmarkRatingRepository;
use App\Domain\SocialCrawler\HatenaBookmarkCountCrawler;

class HatenaBookmarkCrawlerApplication implements SocialCrawlerApplication
{

    use TransactionSocialCrawlerApplication;

    /**
     * コンストラクタ
     *
     * @param HatenaBookmarkCountCrawler $socialCrawler
     * @param HatenaBookmarkRatingRepository $ratingRepository
     */
    public function __construct(HatenaBookmarkCountCrawler $socialCrawler,
                                HatenaBookmarkRatingRepository $ratingRepository)
    {
        $this->construct($socialCrawler, $ratingRepository);
    }

}
