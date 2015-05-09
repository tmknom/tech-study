<?php

namespace Tests\Console\Commands\EventCrawler;

use App\Console\Commands\EventCrawler\AtndCrawlerCommand;
use App\Console\Commands\EventCrawler\ConnpassCrawlerCommand;
use App\Console\Commands\EventCrawler\DoorkeeperCrawlerCommand;
use App\Console\Commands\EventCrawler\PartakeCrawlerCommand;
use App\Console\Commands\EventCrawler\QueueCrawlerCommand;
use App\Console\Commands\EventCrawler\ZusaarCrawlerCommand;
use Artisan;
use Mockery;
use Tests\Base\TestCase;

class QueueCrawlerCommandTest extends TestCase
{

    /** @var QueueCrawlerCommand */
    private $sut;

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->sut = new QueueCrawlerCommand();
    }

    /** @test */
    public function fire_正常系()
    {
        // 事前準備：標準出力をバッファリング
        ob_start();

        // 事前準備：コマンド呼び出し部分をモック化／それぞれのコマンドが一度しか呼ばれていないことも同時に確認
        Artisan::shouldReceive('call')->times(1)->with(AtndCrawlerCommand::COMMAND_NAME);
        Artisan::shouldReceive('call')->times(1)->with(ConnpassCrawlerCommand::COMMAND_NAME);
        Artisan::shouldReceive('call')->times(1)->with(DoorkeeperCrawlerCommand::COMMAND_NAME);
        Artisan::shouldReceive('call')->times(1)->with(ZusaarCrawlerCommand::COMMAND_NAME);
        Artisan::shouldReceive('call')->times(1)->with(PartakeCrawlerCommand::COMMAND_NAME);

        // 事前準備：コマンド呼び出し部分をモック化／上記以外のコマンドが呼ばれてないことも同時を確認
        Artisan::shouldReceive('call')->times(0)->with(Mockery::any());

        // 実行
        $this->sut->fire();

        // 確認
        $this->assertEquals('crawler:queue', $this->sut->getName());

        // 後始末：バッファリングした標準出力を破棄して終了
        ob_end_clean();

        // 後始末：モック化を解除するためアプリケーションをリフレッシュ
        $this->refreshApplication();
    }

}
