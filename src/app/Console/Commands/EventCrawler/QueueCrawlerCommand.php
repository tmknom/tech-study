<?php

namespace App\Console\Commands\EventCrawler;

use App\Commands\ExecuteCommandByQueue;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * 注意）app/Console/Kernel.phpへの追加を忘れないこと！
 *
 * 事前準備：php artisan migrate; php artisan queue:listen &
 * 実行方法：php artisan crawler:queue
 */
class QueueCrawlerCommand extends Command
{

    use DispatchesCommands;

    protected $name = 'crawler:queue';
    protected $description = "クローラコマンド：queue";

    /**
     * コマンド呼び出し時に実行
     */
    public function fire()
    {
        $this->executeCommandByQueue(AtndCrawlerCommand::COMMAND_NAME);
        $this->executeCommandByQueue(ConnpassCrawlerCommand::COMMAND_NAME);
    }

    /**
     * キュー経由でコマンド実行
     *
     * @param string $commandName
     */
    private function executeCommandByQueue($commandName)
    {
        $this->dispatch(new ExecuteCommandByQueue($commandName));
    }

}
