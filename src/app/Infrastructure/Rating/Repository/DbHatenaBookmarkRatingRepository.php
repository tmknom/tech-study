<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\Repository\HatenaBookmarkRatingRepository;

class DbHatenaBookmarkRatingRepository implements HatenaBookmarkRatingRepository
{

    use RatingUpdatableChecker;

    /**
     * はてブ数保存
     *
     * @param EventUrl $eventUrl
     * @param HatenaBookmarkCount $ratingCount
     * @return HatenaBookmarkCount
     */
    public function save(EventUrl $eventUrl, $ratingCount)
    {
        $eventId = $this->checkAndGetEventId($eventUrl, $ratingCount, HatenaBookmarkCount::class);
        return $this->eventRatingORMapper->updateHatenaBookmarkCount($eventId, $ratingCount);
    }

}
