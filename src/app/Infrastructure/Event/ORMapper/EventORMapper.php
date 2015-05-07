<?php

namespace App\Infrastructure\Event\ORMapper;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Event;
use App\Domain\Event\EventId;
use DB;

class EventORMapper
{

    const TABLE_NAME = 'event';

    /**
     * 指定したURLのEventIdを返却する
     * 
     * テーブルに存在しないURLを指定した場合、EventIdは未定義の状態で返却される／nullではないことに注意
     *
     * @param EventUrl $eventUrl
     * @return EventId
     */
    public function findEventId(EventUrl $eventUrl)
    {
        $resultArray = (array) DB::table(self::TABLE_NAME)->select('id')->where('url', '=', $eventUrl)->first();
        if(count($resultArray) === 0){
            return EventId::createUndefinedInstance();
        }
        return new EventId($resultArray['id']);
    }

    /**
     * 指定したURLがテーブルに存在するかチェック
     *
     * @param EventUrl $eventUrl
     * @return boolean 存在すればtrue、存在しなければfalse
     */
    public function existsByEventUrl(EventUrl $eventUrl)
    {
        return DB::table(self::TABLE_NAME)->where('url', '=', $eventUrl)->exists();
    }

    /**
     * テーブルにレコードを一件追加＆ID取得
     *
     * @param Event $event
     * @return EventId
     */
    public function insertGetId(Event $event)
    {
        $id = DB::table(self::TABLE_NAME)->insertGetId($this->toDbArray($event));
        return new EventId($id);
    }

    private function toDbArray(Event $event)
    {
        return array(
            'url' => $event->getEventCore()->getEventUrl()->getValue(),
            'title' => $event->getEventCore()->getEventTitle()->getValue(),
            'start_date_time' => $event->getEventCore()->getStartDateTime()->formatDateTime(),
            'source_type' => $event->getEventCore()->getSourceType()->getValue(),
            'source_event_id' => $event->getEventDetail()->getSourceEventId()->getValue(),
            'description' => $event->getEventDetail()->getEventDescription()->getValue(),
            'catch_copy' => $event->getEventDetail()->getCatchCopy()->getValue(),
            'owner_id' => $event->getEventDetail()->getOwnerId()->getValue(),
            'created_at' => date('Y-m-d H:i:s'),
        );
    }

}
