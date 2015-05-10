<?php

namespace App\Domain\EventSummary;

interface EventSummaryRepository
{

    /**
     * 最新の一覧を取得する
     *
     * @return EventSummaryList
     */
    public function listRecent();

}
