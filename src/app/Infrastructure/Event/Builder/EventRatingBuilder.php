<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Rating\EventRating;
use App\Domain\Event\Rating\FacebookCount;
use App\Domain\Event\Rating\GooglePlusCount;
use App\Domain\Event\Rating\HatenaBookmarkCount;
use App\Domain\Event\Rating\PocketCount;
use App\Domain\Event\Rating\TwitterCount;

class EventRatingBuilder
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

    /** @return EventRatingBuilder */
    public function setHatenaBookmarkCount($hatenaBookmarkCount)
    {
        $this->hatenaBookmarkCount = new HatenaBookmarkCount($hatenaBookmarkCount);
        return $this;
    }

    /** @return EventRatingBuilder */
    public function setTwitterCount($twitterCount)
    {
        $this->twitterCount = new TwitterCount($twitterCount);
        return $this;
    }

    /** @return EventRatingBuilder */
    public function setFacebookCount($facebookCount)
    {
        $this->facebookCount = new FacebookCount($facebookCount);
        return $this;
    }

    /** @return EventRatingBuilder */
    public function setGooglePlusCount($googlePlusCount)
    {
        $this->googlePlusCount = new GooglePlusCount($googlePlusCount);
        return $this;
    }

    /** @return EventRatingBuilder */
    public function setPocketCount($pocketCount)
    {
        $this->pocketCount = new PocketCount($pocketCount);
        return $this;
    }

    /** @return EventRating */
    public function build()
    {
        return new EventRating(
                $this->hatenaBookmarkCount, $this->twitterCount, $this->facebookCount,
                $this->googlePlusCount, $this->pocketCount
        );
    }

    /** @return EventRatingBuilder */
    public static function builder()
    {
        return new EventRatingBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
