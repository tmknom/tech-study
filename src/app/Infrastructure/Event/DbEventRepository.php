<?php

namespace App\Infrastructure\Event;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Event;
use App\Domain\Event\EventId;
use App\Domain\Event\EventList;
use App\Domain\Event\EventRepository;
use App\Domain\Event\Rating\TwitterCount;
use App\Infrastructure\Event\ORMapper\EventCapacityORMapper;
use App\Infrastructure\Event\ORMapper\EventGeolocationORMapper;
use App\Infrastructure\Event\ORMapper\EventORMapper;
use App\Infrastructure\Event\ORMapper\EventRatingORMapper;
use InvalidArgumentException;

class DbEventRepository implements EventRepository
{

    /** @var EventORMapper */
    private $eventORMapper;

    /** @var EventGeolocationORMapper */
    private $eventGeolocationORMapper;

    /** @var EventCapacityORMapper */
    private $eventCapacityORMapper;

    /** @var EventRatingORMapper */
    private $eventRatingORMapper;

    /** コンストラクタ */
    public function __construct()
    {
        $this->eventORMapper = new EventORMapper();
        $this->eventGeolocationORMapper = new EventGeolocationORMapper();
        $this->eventCapacityORMapper = new EventCapacityORMapper();
        $this->eventRatingORMapper = new EventRatingORMapper();
    }

    /**
     * 全て保存
     *
     * @param EventList $eventList
     * @return EventList 保存したイベントのリスト
     */
    public function saveAll(EventList $eventList)
    {
        $registerEventListArray = array();
        foreach ($eventList->toArray() as $event) {
            if (!$this->isRegistered($event)) {
                $this->save($event);
                array_push($registerEventListArray, $event);
            }
        }

        return new EventList($registerEventListArray);
    }

    /**
     * 指定したイベントがテーブルに存在するかチェック
     *
     * @param Event $event
     * @return boolean 存在すればtrue、存在しなければfalse
     */
    private function isRegistered(Event $event)
    {
        return $this->eventORMapper->existsByEventUrl($event->getEventCore()->getEventUrl());
    }

    /**
     * 指定したイベント一件をテーブルに保存
     * 
     * @param Event $event
     */
    private function save(Event $event)
    {
        // event テーブルにレコードを追加＆ID取得
        $eventId = $this->eventORMapper->insertGetId($event);

        // event_geolocation テーブルにレコードを追加
        $this->eventGeolocationORMapper->insert($eventId, $event->getEventGeolocation(), $event->getEventArea());

        // event_capacity テーブルにレコードを追加
        $this->eventCapacityORMapper->insert($eventId, $event->getEventCapacity());

        // event_rating テーブルにレコードを追加
        $this->eventRatingORMapper->insert($eventId, $event->getEventRating());
    }

    /**
     * ツイート数保存
     *
     * @param EventUrl $eventUrl
     * @param TwitterCount $count
     * @return TwitterCount
     */
    public function saveTwitterCount(EventUrl $eventUrl, TwitterCount $count)
    {
        $eventId = $this->getEventId($eventUrl);
        return $this->eventRatingORMapper->updateTwitterCount($eventId, $count);
    }

    /**
     * @return EventId
     * @throws InvalidArgumentException
     */
    private function getEventId(EventUrl $eventUrl)
    {
        $eventId = $this->eventORMapper->findEventId($eventUrl);
        if ($eventId->isUndefined()) {
            throw new InvalidArgumentException('not exist url : ' . $eventUrl);
        }
        return $eventId;
    }

}
