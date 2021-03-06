<?php

namespace App\Infrastructure\Rating\Repository\ORMapper;

use App\Domain\Event\EventId;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\Rating\RatingCount\TwitterCount;
use DB;

class EventRatingORMapper
{

    const TABLE_NAME = 'event_rating';

    /**
     * @param EventId $eventId
     * @param HatenaBookmarkCount $count
     * @return HatenaBookmarkCount
     */
    public function updateHatenaBookmarkCount(EventId $eventId, HatenaBookmarkCount $count)
    {
        return $this->updateValue($eventId, $count, 'hatena_bookmark_count');
    }

    /**
     * @param EventId $eventId
     * @param TwitterCount $count
     * @return TwitterCount
     */
    public function updateTwitterCount(EventId $eventId, TwitterCount $count)
    {
        return $this->updateValue($eventId, $count, 'twitter_count');
    }

    /**
     * @param EventId $eventId
     * @param FacebookCount $count
     * @return FacebookCount
     */
    public function updateFacebookCount(EventId $eventId, FacebookCount $count)
    {
        return $this->updateValue($eventId, $count, 'facebook_count');
    }

    /**
     * @param EventId $eventId
     * @param GooglePlusCount $count
     * @return GooglePlusCount
     */
    public function updateGooglePlusCount(EventId $eventId, GooglePlusCount $count)
    {
        return $this->updateValue($eventId, $count, 'google_plus_count');
    }

    /**
     * @param EventId $eventId
     * @param PocketCount $count
     * @return PocketCount
     */
    public function updatePocketCount(EventId $eventId, PocketCount $count)
    {
        return $this->updateValue($eventId, $count, 'pocket_count');
    }

    private function updateValue(EventId $eventId, $ratingCount, $keyName = '')
    {
        $dbArray = array(
            'event_id' => $eventId,
            $keyName => $ratingCount
        );
        DB::table(self::TABLE_NAME)->where('event_id', $eventId)->update($dbArray);
        return $ratingCount;
    }

}
