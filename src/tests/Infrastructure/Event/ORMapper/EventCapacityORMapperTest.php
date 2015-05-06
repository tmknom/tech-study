<?php

namespace Tests\Infrastructure\Event\ORMapper;

use App\Domain\Event\EventId;
use App\Infrastructure\Event\ORMapper\EventCapacityORMapper;
use DB;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;

class EventCapacityORMapperTest extends TestCase
{

    /** @var EventCapacityORMapper */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new EventCapacityORMapper();
    }

    /** @test */
    public function insert_正常系()
    {
        // 事前準備
        $event = TestEventBuilder::builder()->build();
        $eventId = new EventId(1);

        // 実行
        $this->sut->insert($eventId, $event->getEventCapacity());

        // 確認：テーブル
        $actual = (array) DB::table(EventCapacityORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('30', $actual['capacity_limit']);
        $this->assertEquals('5', $actual['accepted']);
        $this->assertEquals('0', $actual['waiting']);
        $this->assertCount(4, $actual);
    }

}
