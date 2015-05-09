<?php

namespace Tests\Infrastructure\Event\ORMapper;

use App\Domain\Event\EventId;
use App\Infrastructure\Event\ORMapper\EventRatingORMapper;
use DB;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;

class EventRatingORMapperTest extends TestCase
{

    /** @var EventRatingORMapper */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new EventRatingORMapper();
    }

    /** @test */
    public function insert_正常系()
    {
        // 事前準備
        $event = TestEventBuilder::builder()->build();
        $eventId = new EventId(2);

        // 実行
        $this->sut->insert($eventId, $event->getRating());

        // 確認：テーブル
        $actual = (array) DB::table(EventRatingORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('2', $actual['event_id']);
        $this->assertEquals('10', $actual['hatena_bookmark_count']);
        $this->assertEquals('5', $actual['twitter_count']);
        $this->assertEquals('3', $actual['facebook_count']);
        $this->assertEquals('1', $actual['google_plus_count']);
        $this->assertEquals('15', $actual['pocket_count']);
        $this->assertCount(6, $actual);
    }

}
