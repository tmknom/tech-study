<?php

namespace Tests\Console\Commands\EventCrawler;

use App\Application\EventCrawler\DoorkeeperCrawlerApplication;
use App\Console\Commands\EventCrawler\DoorkeeperCrawlerCommand;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\DoorkeeperJsonHttpClient;

class DoorkeeperCrawlerCommandTest extends TestCase
{

    /** @var DoorkeeperCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, DoorkeeperJsonHttpClient::class);
        $crawlerApplication = $this->app->make(DoorkeeperCrawlerApplication::class);
        $this->sut = new DoorkeeperCrawlerCommand($crawlerApplication);
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：標準出力をバッファリング
        ob_start();
        // 実行
        $this->sut->fire();
        // 確認
        $this->assertEquals('crawler:doorkeeper', $this->sut->getName());
        // 後始末：バッファリングした標準出力を破棄して終了
        ob_end_clean();
    }

}
