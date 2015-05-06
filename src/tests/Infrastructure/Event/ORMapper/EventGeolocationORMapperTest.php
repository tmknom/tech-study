<?php

namespace Tests\Infrastructure\Event\ORMapper;

use App\Domain\Event\EventId;
use App\Infrastructure\Event\ORMapper\EventGeolocationORMapper;
use DB;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;

class EventGeolocationORMapperTest extends TestCase
{

    /** @var EventGeolocationORMapper */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new EventGeolocationORMapper();
    }

    /** @test */
    public function insert_正常系()
    {
        // 事前準備
        $event = TestEventBuilder::builder()->build();
        $eventId = new EventId(1);

        // 実行
        $this->sut->insert($eventId, $event->getEventGeolocation(), $event->getEventArea());

        // 確認：テーブル
        $actual = (array) DB::table(EventGeolocationORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('3', $actual['region_code']);
        $this->assertEquals('13', $actual['prefecture_code']);
        $this->assertEquals('東京都千代田区丸の内3丁目5番1号', $actual['address']);
        $this->assertEquals('東京国際フォーラム　ホールB7', $actual['place']);
        $this->assertEquals('35.6769', $actual['latitude']);
        $this->assertEquals('139.7635', $actual['longitude']);
        $this->assertCount(7, $actual);
    }

}
