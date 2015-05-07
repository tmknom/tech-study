<?php

namespace App\Infrastructure\EventUrlList\ORMapper;

use App\Domain\Event\Core\EventUrl;
use App\Domain\EventUrlList\EventUrlList;
use DB;

class EventORMapper
{

    const TABLE_NAME = 'event';

    /**
     * @return EventUrlList
     */
    public function findRecentEventUrlList()
    {
        $resultArray = DB::table(self::TABLE_NAME)->orderBy('start_date_time', 'desc')->lists('url');

        $result = array();
        foreach ($resultArray as $value) {
            array_push($result, new EventUrl($value));
        }
        return new EventUrlList($result);
    }

}
