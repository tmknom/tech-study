<?php

namespace App\Domain\Event;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Rating\FacebookCount;
use App\Domain\Event\Rating\TwitterCount;

interface EventRepository
{

    /**
     * 全て保存
     *
     * @param EventList $eventList
     * @return EventList
     */
    public function saveAll(EventList $eventList);

    /**
     * ツイート数保存
     *
     * @param EventUrl $eventUrl
     * @param TwitterCount $count
     * @return TwitterCount
     */
    public function saveTwitterCount(EventUrl $eventUrl, TwitterCount $count);

    /**
     * イイネ数保存
     *
     * @param EventUrl $eventUrl
     * @param FacebookCount $count
     * @return FacebookCount
     */
    public function saveFacebookCount(EventUrl $eventUrl, FacebookCount $count);

}
