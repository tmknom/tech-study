<?php

namespace App\Infrastructure\EventUrlList;

use App\Domain\EventUrlList\EventUrlList;
use App\Domain\EventUrlList\EventUrlListRepository;
use App\Infrastructure\EventUrlList\ORMapper\EventORMapper;

class DbEventUrlListRepository implements EventUrlListRepository
{

    /** @var EventORMapper */
    private $eventORMapper;

    /** コンストラクタ */
    public function __construct()
    {
        $this->eventORMapper = new EventORMapper();
    }

    /**
     * 最新のURL一覧参照
     *
     * @return EventUrlList
     */
    public function referRecent()
    {
        return $this->eventORMapper->findRecentEventUrlList();
    }

}
