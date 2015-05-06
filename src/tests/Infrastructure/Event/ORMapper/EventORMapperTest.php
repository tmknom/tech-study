<?php

namespace Tests\Infrastructure\Event\ORMapper;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\EventId;
use App\Infrastructure\Event\ORMapper\EventORMapper;
use DB;
use TestCase;
use Tests\Fixture\Seeder\EventSeeder;
use Tests\Infrastructure\Event\TestEventBuilder;

class EventORMapperTest extends TestCase
{

    /** @var EventORMapper */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new EventORMapper();
    }

    /** @test */
    public function existsByEventUrl_正常系_登録されてないURLを指定()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        // 事前準備
        $eventUrl = new EventUrl('http://localhost/not-registered');

        // 実行
        $actual = $this->sut->existsByEventUrl($eventUrl);

        // 確認
        $this->assertEquals(false, $actual);
    }

    /** @test */
    public function existsByEventUrl_正常系_登録済みのURLを指定()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        // 事前準備
        $eventUrl = TestEventBuilder::builder()->build()->getEventCore()->getEventUrl();

        // 実行
        $actual = $this->sut->existsByEventUrl($eventUrl);

        // 確認
        $this->assertEquals(true, $actual);
    }

    /** @test */
    public function insertGetId_正常系()
    {
        // 事前準備
        $event = TestEventBuilder::builder()->build();

        // 実行
        $actualEventId = $this->sut->insertGetId($event);

        // 確認
        $this->assertEquals(new EventId(1), $actualEventId);

        // 確認：テーブル
        $actual = (array) DB::table(EventORMapper::TABLE_NAME)->where('id', '=', 1)->first();
        $this->assertEquals('1', $actual['id']);
        $this->assertEquals('http://atnd.org/events/17662', $actual['url']);
        $this->assertEquals('サンプルイベント1', $actual['title']);
        $this->assertEquals('2014-10-20 19:00:00', $actual['start_date_time']);
        $this->assertEquals('atnd', $actual['source_type']);
        $this->assertEquals('17662', $actual['source_event_id']);
        $this->assertEquals('概要1', $actual['description']);
        $this->assertEquals('キャッチコピー1', $actual['catch_copy']);
        $this->assertEquals('10000', $actual['owner_id']);
        $this->assertNotEmpty($actual['created_at']);
        $this->assertNotEmpty($actual['updated_at']);
        $this->assertCount(11, $actual);
    }

}
