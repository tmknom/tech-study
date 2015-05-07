<?php

namespace Tests\Infrastructure\EventUrlList\ORMapper;

use App\Domain\EventUrlList\EventUrlList;
use App\Infrastructure\EventUrlList\ORMapper\EventORMapper;
use Tests\Base\TestCase;
use Tests\Fixture\Seeder\EventSeeder;

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
    public function findRecentEventUrlList_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);

        // 実行
        $actual = $this->sut->findRecentEventUrlList();

        // 確認
        $this->assertTrue($actual instanceof EventUrlList);
        $this->assertEquals(1, $actual->count());
        $this->assertEquals('http://atnd.org/events/17662', $actual->get(0));
    }

    /** @test */
    public function findRecentEventUrlList_正常系_結果が空の場合()
    {
        // 実行
        $actual = $this->sut->findRecentEventUrlList();

        // 確認
        $this->assertTrue($actual instanceof EventUrlList);
        $this->assertEquals(0, $actual->count());
    }

}
