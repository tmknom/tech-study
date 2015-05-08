<?php

namespace Tests\Console\Commands\EventCrawler;

use App\Application\EventCrawler\AtndCrawlerApplication;
use App\Console\Commands\EventCrawler\AtndCrawlerCommand;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Infrastructure\EventCrawler\Stub\AtndJsonHttpClient;

class AtndCrawlerCommandTest extends TestCase
{

    /** @var AtndCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, AtndJsonHttpClient::class);
        $crawlerApplication = $this->app->make(AtndCrawlerApplication::class);
        $this->sut = new AtndCrawlerCommand($crawlerApplication);
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：標準出力をバッファリング
        ob_start();
        // 実行
        $this->sut->fire();
        // 確認
        $this->assertEquals('crawler:atnd', $this->sut->getName());
        // 後始末：バッファリングした標準出力を破棄して終了
        ob_end_clean();
    }

}
