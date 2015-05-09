<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\Rating\Repository\GooglePlusRatingRepository;

class DbGooglePlusRatingRepository implements GooglePlusRatingRepository
{

    use RatingUpdatableChecker;

    /**
     * あとで読む数保存
     *
     * @param EventUrl $eventUrl
     * @param GooglePlusCount $ratingCount
     * @return GooglePlusCount
     */
    public function save(EventUrl $eventUrl, $ratingCount)
    {
        $eventId = $this->checkAndGetEventId($eventUrl, $ratingCount, GooglePlusCount::class);
        return $this->eventRatingORMapper->updateGooglePlusCount($eventId, $ratingCount);
    }

}
