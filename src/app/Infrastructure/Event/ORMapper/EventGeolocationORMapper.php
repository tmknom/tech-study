<?php

namespace App\Infrastructure\Event\ORMapper;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\EventId;
use App\Domain\Event\Geolocation\EventGeolocation;
use DB;

class EventGeolocationORMapper
{

    const TABLE_NAME = 'event_geolocation';

    /**
     * テーブルにレコードを一件追加
     *
     * @param EventId $eventId
     * @param EventGeolocation $eventGeolocation
     * @param EventArea $eventArea
     */
    public function insert(EventId $eventId, EventGeolocation $eventGeolocation, EventArea $eventArea)
    {
        $insertArray = $this->toDbArray($eventId, $eventGeolocation, $eventArea);
        DB::table(self::TABLE_NAME)->insert($insertArray);
    }

    private function toDbArray(EventId $eventId, EventGeolocation $eventGeolocation, EventArea $eventArea)
    {
        return array(
            'event_id' => $eventId,
            'region_code' => $eventArea->getRegionCode(),
            'prefecture_code' => $eventArea->getPrefectureCode(),
            'address' => $eventGeolocation->getAddress(),
            'place' => $eventGeolocation->getPlace(),
            'latitude' => $eventGeolocation->getLatitude(),
            'longitude' => $eventGeolocation->getLongitude(),
        );
    }

}
