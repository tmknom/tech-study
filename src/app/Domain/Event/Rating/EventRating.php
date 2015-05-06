<?php

namespace App\Domain\Event\Rating;

use App\Library\Domain\Entity;

class EventRating
{

    use Entity;

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
