<?php

namespace Tests\Infrastructure\Event;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\EventList;
use App\Domain\Event\Rating\TwitterCount;
use App\Infrastructure\Event\DbEventRepository;
use App\Infrastructure\Event\ORMapper\EventCapacityORMapper;
use App\Infrastructure\Event\ORMapper\EventGeolocationORMapper;
use App\Infrastructure\Event\ORMapper\EventORMapper;
use App\Infrastructure\Event\ORMapper\EventRatingORMapper;
use DB;
use InvalidArgumentException;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;
use Tests\Fixture\Seeder\EventCapacitySeeder;
use Tests\Fixture\Seeder\EventGeolocationSeeder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;

class DbEventRepositoryTest extends TestCase
{

    /** @var DbEventRepository */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new DbEventRepository();
    }

    /** @test */
    public function saveAll_正常系()
    {
        // 事前確認
        $this->assertEquals(0, DB::table(EventORMapper::TABLE_NAME)->count());
        $this->assertEquals(0, DB::table(EventGeolocationORMapper::TABLE_NAME)->count());
        $this->assertEquals(0, DB::table(EventCapacityORMapper::TABLE_NAME)->count());
        $this->assertEquals(0, DB::table(EventRatingORMapper::TABLE_NAME)->count());

        // 事前準備
        $event1 = TestEventBuilder::builder()->setEventUrl('http://atnd.org/events/17662')->build();
        $event2 = TestEventBuilder::builder()->setEventUrl('http://atnd.org/events/10000')->build();
        $eventList = new EventList(array($event1, $event2));

        // 実行
        $this->sut->saveAll($eventList);

        // 確認
        $this->assertEquals(2, DB::table(EventORMapper::TABLE_NAME)->count());
        $this->assertEquals(2, DB::table(EventGeolocationORMapper::TABLE_NAME)->count());
        $this->assertEquals(2, DB::table(EventCapacityORMapper::TABLE_NAME)->count());
        $this->assertEquals(2, DB::table(EventRatingORMapper::TABLE_NAME)->count());
    }

    /** @test */
    public function saveAll_正常系_すでに登録済みのURLがある場合()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventGeolocationSeeder::class);
        $this->seed(EventCapacitySeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前確認
        $this->assertEquals(1, DB::table(EventORMapper::TABLE_NAME)->count());
        $this->assertEquals(1, DB::table(EventGeolocationORMapper::TABLE_NAME)->count());
        $this->assertEquals(1, DB::table(EventCapacityORMapper::TABLE_NAME)->count());
        $this->assertEquals(1, DB::table(EventRatingORMapper::TABLE_NAME)->count());

        // 事前準備
        $event1 = TestEventBuilder::builder()->setEventUrl('http://atnd.org/events/17662')->build();
        $event2 = TestEventBuilder::builder()->setEventUrl('http://atnd.org/events/10000')->build();
        $eventList = new EventList(array($event1, $event2));

        // 実行
        $actual = $this->sut->saveAll($eventList);

        // 確認
        $this->assertEquals(2, DB::table(EventORMapper::TABLE_NAME)->count());
        $this->assertEquals(2, DB::table(EventGeolocationORMapper::TABLE_NAME)->count());
        $this->assertEquals(2, DB::table(EventCapacityORMapper::TABLE_NAME)->count());
        $this->assertEquals(2, DB::table(EventRatingORMapper::TABLE_NAME)->count());
        // 確認：まだ存在しない一件だけ登録されたことを確認
        $this->assertEquals(new EventList(array($event2)), $actual);
    }

    /** @test */
    public function saveTwitterCount_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new TwitterCount(800);
        $eventUrl = TestEventBuilder::builder()->build()->getEventCore()->getEventUrl();

        // 実行
        $actual = $this->sut->saveTwitterCount($eventUrl, $count);

        // 確認
        $this->assertEquals(new TwitterCount(800), $actual);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function saveTwitterCount_異常系_存在しないURLが指定された場合()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new TwitterCount(800);
        $eventUrl = new EventUrl('http://localhost/not-registered');

        // 実行
        $this->sut->saveTwitterCount($eventUrl, $count);
    }

}
