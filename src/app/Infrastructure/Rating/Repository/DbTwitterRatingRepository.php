<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Domain\Rating\Repository\TwitterRatingRepository;

class DbTwitterRatingRepository implements TwitterRatingRepository
{

    use RatingUpdatableChecker;

    /**
     * ツイート数保存
     *
     * @param EventUrl $eventUrl
     * @param TwitterCount $ratingCount
     * @return TwitterCount
     */
    public function save(EventUrl $eventUrl, $ratingCount)
    {
        $eventId = $this->checkAndGetEventId($eventUrl, $ratingCount, TwitterCount::class);
        return $this->eventRatingORMapper->updateTwitterCount($eventId, $ratingCount);
    }

}
