<?php

namespace App\Infrastructure\EventSummary;

use App\Domain\EventSummary\EventSummaryList;
use App\Domain\EventSummary\EventSummaryRepository;
use App\Infrastructure\EventSummary\ORMapper\EventORMapper;

class DbEventSummaryRepository implements EventSummaryRepository
{

    /** @var EventORMapper */
    private $eventORMapper;

    /** コンストラクタ */
    public function __construct()
    {
        $this->eventORMapper = new EventORMapper();
    }

    /**
     * 最新の一覧を取得する
     *
     * @return EventSummaryList
     */
    public function listRecent()
    {
        return $this->eventORMapper->listRecent();
    }

}
