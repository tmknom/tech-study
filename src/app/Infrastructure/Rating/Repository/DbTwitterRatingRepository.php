<?php

namespace App\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\EventId;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Domain\Rating\Repository\TwitterRatingRepository;
use App\Infrastructure\Event\ORMapper\EventORMapper;
use App\Infrastructure\Rating\Repository\ORMapper\EventRatingORMapper;
use InvalidArgumentException;

class DbTwitterRatingRepository implements TwitterRatingRepository
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
     * ツイート数保存
     *
     * @param EventUrl $eventUrl
     * @param TwitterCount $ratingCount
     * @return TwitterCount
     */
    public function save(EventUrl $eventUrl, $ratingCount)
    {
        $this->checkType($ratingCount, TwitterCount::class);
        $eventId = $this->getEventId($eventUrl);
        return $this->eventRatingORMapper->updateTwitterCount($eventId, $ratingCount);
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
