<?php

namespace Tests\Infrastructure\EventUrlList;

use App\Domain\EventUrlList\EventUrlList;
use App\Infrastructure\EventUrlList\DbEventUrlListRepository;
use Tests\Base\TestCase;
use Tests\Fixture\Seeder\EventSeeder;

class DbEventUrlListRepositoryTest extends TestCase
{

    /** @var DbEventUrlListRepository */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new DbEventUrlListRepository();
    }

    /** @test */
    public function referRecent_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);

        // 実行
        $actual = $this->sut->referRecent();

        // 確認
        $this->assertTrue($actual instanceof EventUrlList);
        $this->assertEquals(1, $actual->count());
        $this->assertEquals('http://atnd.org/events/17662', $actual->get(0));
    }

}
