<?php

namespace App\Infrastructure\Event\ORMapper;

use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\EventId;
use DB;

class EventCapacityORMapper
{

    const TABLE_NAME = 'event_capacity';

    /**
     * テーブルにレコードを一件追加
     *
     * @param EventId $eventId
     * @param EventCapacity $eventCapacity
     */
    public function insert(EventId $eventId, EventCapacity $eventCapacity)
    {
        $insertArray = $this->toDbArray($eventId, $eventCapacity);
        DB::table(self::TABLE_NAME)->insert($insertArray);
    }

    private function toDbArray(EventId $eventId, EventCapacity $eventCapacity)
    {
        return array(
            'event_id' => $eventId,
            'capacity_limit' => $eventCapacity->getCapacityLimit(),
            'accepted' => $eventCapacity->getAccepted(),
            'waiting' => $eventCapacity->getWaiting(),
        );
    }

}
