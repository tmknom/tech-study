<?php

namespace Tests\Infrastructure\EventSummary;

use App\Domain\EventSummary\EventSummaryList;
use App\Infrastructure\EventSummary\DbEventSummaryRepository;
use Tests\Base\TestCase;
use Tests\Fixture\Seeder\EventCapacitySeeder;
use Tests\Fixture\Seeder\EventGeolocationSeeder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;

class DbEventSummaryRepositoryTest extends TestCase
{

    /** @var DbEventSummaryRepository */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new DbEventSummaryRepository();
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
