<?php

namespace App\Domain\EventUrlList;

interface EventUrlListRepository
{

    /**
     * 最新のURL一覧参照
     *
     * @return EventUrlList
     */
    public function referRecent();

}
