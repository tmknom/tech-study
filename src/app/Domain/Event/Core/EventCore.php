<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\Aggregate;

class EventCore
{

    use Aggregate;

    /** @var EventTitle */
    private $eventTitle;

    /** @var EventUrl */
    private $eventUrl;

    /** @var StartDateTime */
    private $startDateTime;

    /** @var SourceType */
    private $sourceType;

    /**
     * コンストラクタ
     *
     * @param EventTitle $eventTitle
     * @param EventUrl $eventUrl
     * @param StartDateTime $startDateTime
     * @param SourceType $sourceType
     */
    public function __construct(EventTitle $eventTitle, EventUrl $eventUrl,
                                StartDateTime $startDateTime, SourceType $sourceType)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * 開始日が一年以内かどうか判定する
     *
     * @return boolean 一年以内だったらtrue、そうでなければfalse
     */
    public function isStartWithinOneYear()
    {
        return $this->startDateTime->isWithinOneYear();
    }

    /**
     * @return EventTitle
     */
    public function getEventTitle()
    {
        return $this->eventTitle;
    }

    /**
     * @return EventUrl
     */
    public function getEventUrl()
    {
        return $this->eventUrl;
    }

    /**
     * @return SourceType
     */
    public function getSourceType()
    {
        return $this->sourceType;
    }

    /**
     * @return StartDateTime
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

}
