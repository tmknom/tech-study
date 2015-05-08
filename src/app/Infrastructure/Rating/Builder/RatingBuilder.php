<?php

namespace App\Infrastructure\Rating\Builder;

use App\Domain\Rating\Rating;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\Rating\RatingCount\TwitterCount;

class RatingBuilder
{

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

    /** @return RatingBuilder */
    public function setHatenaBookmarkCount($hatenaBookmarkCount)
    {
        $this->hatenaBookmarkCount = new HatenaBookmarkCount($hatenaBookmarkCount);
        return $this;
    }

    /** @return RatingBuilder */
    public function setTwitterCount($twitterCount)
    {
        $this->twitterCount = new TwitterCount($twitterCount);
        return $this;
    }

    /** @return RatingBuilder */
    public function setFacebookCount($facebookCount)
    {
        $this->facebookCount = new FacebookCount($facebookCount);
        return $this;
    }

    /** @return RatingBuilder */
    public function setGooglePlusCount($googlePlusCount)
    {
        $this->googlePlusCount = new GooglePlusCount($googlePlusCount);
        return $this;
    }

    /** @return RatingBuilder */
    public function setPocketCount($pocketCount)
    {
        $this->pocketCount = new PocketCount($pocketCount);
        return $this;
    }

    /** @return Rating */
    public function build()
    {
        return new Rating(
                $this->hatenaBookmarkCount, $this->twitterCount, $this->facebookCount,
                $this->googlePlusCount, $this->pocketCount
        );
    }

    /** @return RatingBuilder */
    public static function builder()
    {
        return new RatingBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
