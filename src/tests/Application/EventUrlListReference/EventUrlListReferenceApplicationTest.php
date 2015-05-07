<?php

namespace Tests\Application\EventUrlListReference;

use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
use App\Domain\EventUrlList\EventUrlList;
use Tests\Base\TestCase;
use Tests\Fixture\Seeder\EventSeeder;

class EventUrlListReferenceApplicationTest extends TestCase
{

    /** @var EventUrlListReferenceApplication */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->sut = $this->app->make(EventUrlListReferenceApplication::class);
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
