<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\Rating\Repository\PocketRatingRepository;

class DbPocketRatingRepository implements PocketRatingRepository
{

    use RatingUpdatableChecker;

    /**
     * あとで読む数保存
     *
     * @param EventUrl $eventUrl
     * @param PocketCount $ratingCount
     * @return PocketCount
     */
    public function save(EventUrl $eventUrl, $ratingCount)
    {
        $eventId = $this->checkAndGetEventId($eventUrl, $ratingCount, PocketCount::class);
        return $this->eventRatingORMapper->updatePocketCount($eventId, $ratingCount);
    }

}
