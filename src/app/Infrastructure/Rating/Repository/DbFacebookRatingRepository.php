<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\Repository\FacebookRatingRepository;

class DbFacebookRatingRepository implements FacebookRatingRepository
{

    use RatingUpdatableChecker;

    /**
     * イイネ数保存
     *
     * @param EventUrl $eventUrl
     * @param FacebookCount $ratingCount
     * @return FacebookCount
     */
    public function save(EventUrl $eventUrl, $ratingCount)
    {
        $eventId = $this->checkAndGetEventId($eventUrl, $ratingCount, FacebookCount::class);
        return $this->eventRatingORMapper->updateFacebookCount($eventId, $ratingCount);
    }

}
