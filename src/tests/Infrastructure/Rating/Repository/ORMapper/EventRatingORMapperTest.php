<?php

namespace Tests\Infrastructure\Rating\Repository\ORMapper;

use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Infrastructure\Rating\Repository\ORMapper\EventRatingORMapper;
use DB;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;
use Tests\Fixture\Seeder\EventRatingSeeder;

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
    public function updateHatenaBookmarkCount_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new HatenaBookmarkCount(1000);
        $eventId = TestEventBuilder::builder()->build()->getEventId();

        // 実行
        $actualHatenaBookmarkCount = $this->sut->updateHatenaBookmarkCount($eventId, $count);

        // 確認
        $this->assertEquals($count, $actualHatenaBookmarkCount);

        // 確認：テーブル
        $actual = (array) DB::table(EventRatingORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('1000', $actual['hatena_bookmark_count']);
    }

    /** @test */
    public function updateTwitterCount_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new TwitterCount(1000);
        $eventId = TestEventBuilder::builder()->build()->getEventId();

        // 実行
        $actualTwitterCount = $this->sut->updateTwitterCount($eventId, $count);

        // 確認
        $this->assertEquals($count, $actualTwitterCount);

        // 確認：テーブル
        $actual = (array) DB::table(EventRatingORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('1000', $actual['twitter_count']);
    }

    /** @test */
    public function updateFacebookCount_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new FacebookCount(1000);
        $eventId = TestEventBuilder::builder()->build()->getEventId();

        // 実行
        $actualFacebookCount = $this->sut->updateFacebookCount($eventId, $count);

        // 確認
        $this->assertEquals($count, $actualFacebookCount);

        // 確認：テーブル
        $actual = (array) DB::table(EventRatingORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('1000', $actual['facebook_count']);
    }

    /** @test */
    public function updateGooglePlusCount_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new GooglePlusCount(1000);
        $eventId = TestEventBuilder::builder()->build()->getEventId();

        // 実行
        $actualGooglePlusCount = $this->sut->updateGooglePlusCount($eventId, $count);

        // 確認
        $this->assertEquals($count, $actualGooglePlusCount);

        // 確認：テーブル
        $actual = (array) DB::table(EventRatingORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('1000', $actual['google_plus_count']);
    }

    /** @test */
    public function updatePocketCount_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $count = new PocketCount(1000);
        $eventId = TestEventBuilder::builder()->build()->getEventId();

        // 実行
        $actualPocketCount = $this->sut->updatePocketCount($eventId, $count);

        // 確認
        $this->assertEquals($count, $actualPocketCount);

        // 確認：テーブル
        $actual = (array) DB::table(EventRatingORMapper::TABLE_NAME)->where('event_id', '=', $eventId)->first();
        $this->assertEquals('1', $actual['event_id']);
        $this->assertEquals('1000', $actual['pocket_count']);
    }

}
