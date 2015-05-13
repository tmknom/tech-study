<?php

namespace Tests\Application\EventList;

use App\Application\EventList\EventListApplication;
use App\Domain\EventSummary\EventSummaryList;
use Tests\Base\TestCase;
use Tests\Fixture\Seeder\EventCapacitySeeder;
use Tests\Fixture\Seeder\EventGeolocationSeeder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;

class EventListApplicationTest extends TestCase
{

    /** @var EventListApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = $this->app->make(EventListApplication::class);
    }

    /** @test */
    public function listRecent_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);
        $this->seed(EventGeolocationSeeder::class);
        $this->seed(EventCapacitySeeder::class);

        // 実行
        $actual = $this->sut->listRecent();

        // 確認
        $this->assertTrue($actual instanceof EventSummaryList);
        $this->assertEquals(1, $actual->count());
        $this->assertEquals('サンプルイベント1', $actual->get(0)->getEventCore()->getEventTitle());
    }

}
