<?php

namespace Tests\Infrastructure\Rating\Repository;

use App\Domain\Event\Core\EventUrl;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Infrastructure\Rating\Repository\DbHatenaBookmarkRatingRepository;
use InvalidArgumentException;
use Tests\Base\TestCase;
use Tests\Fixture\Builder\TestEventBuilder;
use Tests\Fixture\Seeder\EventRatingSeeder;
use Tests\Fixture\Seeder\EventSeeder;

class DbHatenaBookmarkRatingRepositoryTest extends TestCase
{

    /** @var DbHatenaBookmarkRatingRepository */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        // テスト対象のオブジェクト作成
        $this->sut = new DbHatenaBookmarkRatingRepository();
    }

    /** @test */
    public function save_正常系()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $ratingCount = new HatenaBookmarkCount(800);
        $eventUrl = TestEventBuilder::builder()->build()->getEventCore()->getEventUrl();

        // 実行
        $actual = $this->sut->save($eventUrl, $ratingCount);

        // 確認
        $this->assertEquals(new HatenaBookmarkCount(800), $actual);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function save_異常系_存在しないURLが指定された場合()
    {
        // 事前準備：DBに初期データをセット
        $this->seed(EventSeeder::class);
        $this->seed(EventRatingSeeder::class);

        // 事前準備
        $ratingCount = new HatenaBookmarkCount(800);
        $eventUrl = new EventUrl('http://localhost/not-registered');

        // 実行
        $this->sut->save($eventUrl, $ratingCount);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function save_異常系_HatenaBookmarkCount以外が引数に渡された場合()
    {
        // 事前準備
        $ratingCount = new TestRatingCount(800);
        $eventUrl = new EventUrl('http://localhost/not-registered');

        // 実行
        $this->sut->save($eventUrl, $ratingCount);
    }

}
