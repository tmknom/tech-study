<?php

namespace Tests\Console\Commands\EventCrawler;

use App\Application\EventCrawler\ConnpassCrawlerApplication;
use App\Console\Commands\EventCrawler\ConnpassCrawlerCommand;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\ConnpassJsonHttpClient;

class ConnpassCrawlerCommandTest extends TestCase
{

    /** @var ConnpassCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, ConnpassJsonHttpClient::class);
        $crawlerApplication = $this->app->make(ConnpassCrawlerApplication::class);
        $this->sut = new ConnpassCrawlerCommand($crawlerApplication);
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：標準出力をバッファリング
        ob_start();
        // 実行
        $this->sut->fire();
        // 確認
        $this->assertEquals('crawler:connpass', $this->sut->getName());
        // 後始末：バッファリングした標準出力を破棄して終了
        ob_end_clean();
    }

}
