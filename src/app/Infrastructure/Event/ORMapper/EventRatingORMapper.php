<?php

namespace App\Infrastructure\Event\ORMapper;

use App\Domain\Event\EventId;
use App\Domain\Event\Rating\EventRating;
use App\Domain\Event\Rating\FacebookCount;
use App\Domain\Event\Rating\GooglePlusCount;
use App\Domain\Event\Rating\HatenaBookmarkCount;
use App\Domain\Event\Rating\PocketCount;
use App\Domain\Event\Rating\TwitterCount;
use DB;

class EventRatingORMapper
{

    const TABLE_NAME = 'event_rating';

    /**
     * テーブルにレコードを一件追加
     *
     * @param EventId $eventId
     * @param EventRating $eventRating
     */
    public function insert(EventId $eventId, EventRating $eventRating)
    {
        $dbArray = $this->toDbArray($eventId, $eventRating);
        DB::table(self::TABLE_NAME)->insert($dbArray);
    }

    private function toDbArray(EventId $eventId, EventRating $eventRating)
    {
        return array(
            'event_id' => $eventId,
            'hatena_bookmark_count' => $eventRating->getHatenaBookmarkCount(),
            'twitter_count' => $eventRating->getTwitterCount(),
            'facebook_count' => $eventRating->getFacebookCount(),
            'google_plus_count' => $eventRating->getGooglePlusCount(),
            'pocket_count' => $eventRating->getPocketCount(),
        );
    }

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
