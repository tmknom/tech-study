<?php

namespace Tests\Console\Commands\EventCrawler;

use App\Application\EventCrawler\PartakeCrawlerApplication;
use App\Console\Commands\EventCrawler\PartakeCrawlerCommand;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\PartakeJsonHttpClient;

class PartakeCrawlerCommandTest extends TestCase
{

    /** @var PartakeCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, PartakeJsonHttpClient::class);
        $crawlerApplication = $this->app->make(PartakeCrawlerApplication::class);
        $this->sut = new PartakeCrawlerCommand($crawlerApplication);
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：標準出力をバッファリング
        ob_start();
        // 実行
        $this->sut->fire();
        // 確認
        $this->assertEquals('crawler:partake', $this->sut->getName());
        // 後始末：バッファリングした標準出力を破棄して終了
        ob_end_clean();
    }

}
