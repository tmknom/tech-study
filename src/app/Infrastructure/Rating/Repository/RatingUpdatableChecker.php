<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\EventId;
use App\Infrastructure\Event\ORMapper\EventORMapper;
use App\Infrastructure\Rating\Repository\ORMapper\EventRatingORMapper;
use InvalidArgumentException;

trait RatingUpdatableChecker
{

    /** @var EventORMapper */
    private $eventORMapper;

    /** @var EventRatingORMapper */
    private $eventRatingORMapper;

    /** コンストラクタ */
    public function __construct()
    {
        $this->eventORMapper = new EventORMapper();
        $this->eventRatingORMapper = new EventRatingORMapper();
    }

    /**
     * 更新できるかチェックし、可能であれば、EventIdを取得する
     *
     * @param EventUrl $eventUrl
     * @param mixed $ratingCount
     * @param mixed $class
     * @return EventId
     */
    private function checkAndGetEventId(EventUrl $eventUrl, $ratingCount, $class)
    {
        $this->checkType($ratingCount, $class);
        return $this->getEventId($eventUrl);
    }

    /**
     * タイプヒンティングが使えないので、自力で型チェックを行う
     *
     * @param mixed $ratingCount
     * @param mixed $class
     * @throws InvalidArgumentException
     */
    private function checkType($ratingCount, $class)
    {
        if (!($ratingCount instanceof $class)) {
            throw new InvalidArgumentException('Second argument is only ' . $class);
        }
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
