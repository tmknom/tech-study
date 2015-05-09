<?php

namespace App\Domain\Event;

interface EventRepository
{

    /**
     * 全て保存
     *
     * @param EventList $eventList
     * @return EventList
     */
    public function saveAll(EventList $eventList);

}
