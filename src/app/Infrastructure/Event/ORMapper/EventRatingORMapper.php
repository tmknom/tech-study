<?php

namespace App\Infrastructure\Event\ORMapper;

use App\Domain\Event\EventId;
use App\Domain\Rating\Rating;
use DB;

class EventRatingORMapper
{

    const TABLE_NAME = 'event_rating';

    /**
     * テーブルにレコードを一件追加
     *
     * @param EventId $eventId
     * @param Rating $rating
     */
    public function insert(EventId $eventId, Rating $rating)
    {
        $dbArray = $this->toDbArray($eventId, $rating);
        DB::table(self::TABLE_NAME)->insert($dbArray);
    }

    private function toDbArray(EventId $eventId, Rating $rating)
    {
        return array(
            'event_id' => $eventId,
            'hatena_bookmark_count' => $rating->getHatenaBookmarkCount(),
            'twitter_count' => $rating->getTwitterCount(),
            'facebook_count' => $rating->getFacebookCount(),
            'google_plus_count' => $rating->getGooglePlusCount(),
            'pocket_count' => $rating->getPocketCount(),
        );
    }

}
