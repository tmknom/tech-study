<?php

namespace Tests\Console\Commands\EventCrawler;

use App\Application\EventCrawler\ZusaarCrawlerApplication;
use App\Console\Commands\EventCrawler\ZusaarCrawlerCommand;
use App\Library\Http\JsonHttpClient;
use Tests\Base\TestCase;
use Tests\Fixture\Stub\Event\ZusaarJsonHttpClient;

class ZusaarCrawlerCommandTest extends TestCase
{

    /** @var ZusaarCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->app->bind(JsonHttpClient::class, ZusaarJsonHttpClient::class);
        $crawlerApplication = $this->app->make(ZusaarCrawlerApplication::class);
        $this->sut = new ZusaarCrawlerCommand($crawlerApplication);
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：標準出力をバッファリング
        ob_start();
        // 実行
        $this->sut->fire();
        // 確認
        $this->assertEquals('crawler:zusaar', $this->sut->getName());
        // 後始末：バッファリングした標準出力を破棄して終了
        ob_end_clean();
    }

}
