<?php

namespace App\Domain\Rating;

use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Library\Domain\Aggregate;

class Rating
{

    use Aggregate;

    /** @var HatenaBookmarkCount */
    private $hatenaBookmarkCount;

    /** @var TwitterCount */
    private $twitterCount;

    /** @var FacebookCount */
    private $facebookCount;

    /** @var GooglePlusCount */
    private $googlePlusCount;

    /** @var PocketCount */
    private $pocketCount;

    /**
     * コンストラクタ
     *
     * @param HatenaBookmarkCount $hatenaBookmarkCount
     * @param TwitterCount $twitterCount
     * @param FacebookCount $facebookCount
     * @param GooglePlusCount $googlePlusCount
     * @param PocketCount $pocketCount
     */
    public function __construct(HatenaBookmarkCount $hatenaBookmarkCount,
                                TwitterCount $twitterCount, FacebookCount $facebookCount,
                                GooglePlusCount $googlePlusCount, PocketCount $pocketCount)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * @return HatenaBookmarkCount
     */
    public function getHatenaBookmarkCount()
    {
        return $this->hatenaBookmarkCount;
    }

    /**
     * @return TwitterCount
     */
    public function getTwitterCount()
    {
        return $this->twitterCount;
    }

    /**
     * @return FacebookCount
     */
    public function getFacebookCount()
    {
        return $this->facebookCount;
    }

    /**
     * @return GooglePlusCount
     */
    public function getGooglePlusCount()
    {
        return $this->googlePlusCount;
    }

    /**
     * @return PocketCount
     */
    public function getPocketCount()
    {
        return $this->pocketCount;
    }

}
