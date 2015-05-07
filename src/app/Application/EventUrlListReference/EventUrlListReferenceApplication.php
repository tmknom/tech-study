<?php

namespace App\Application\EventUrlListReference;

use App\Domain\EventUrlList\EventUrlList;
use App\Domain\EventUrlList\EventUrlListRepository;

class EventUrlListReferenceApplication
{

    /**  @var EventUrlListRepository */
    private $eventUrlListRepository;

    /**
     * コンストラクタ
     *
     * @param EventUrlListRepository $eventUrlListRepository
     */
    public function __construct(EventUrlListRepository $eventUrlListRepository)
    {
        $this->eventUrlListRepository = $eventUrlListRepository;
    }

    /**
     * 最新のURL一覧を取得する
     *
     * @return EventUrlList
     */
    public function referRecent()
    {
        return $this->eventUrlListRepository->referRecent();
    }

}
