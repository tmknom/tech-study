<?php

namespace App\Application\EventList;

use App\Domain\EventSummary\EventSummaryList;
use App\Domain\EventSummary\EventSummaryRepository;

class EventListApplication
{

    /**  @var EventSummaryRepository */
    private $eventSummaryRepository;

    /**
     * コンストラクタ
     *
     * @param EventSummaryRepository $eventSummaryRepository
     */
    public function __construct(EventSummaryRepository $eventSummaryRepository)
    {
        $this->eventSummaryRepository = $eventSummaryRepository;
    }

    /**
     * 最新のイベント一覧を取得する
     *
     * @return EventSummaryList
     */
    public function listRecent()
    {
        return $this->eventSummaryRepository->listRecent();
    }

}
