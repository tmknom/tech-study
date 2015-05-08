<?php

namespace App\Commands;

use App\Commands\Command;
use Artisan;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExecuteCommandByQueue extends Command implements SelfHandling, ShouldBeQueued
{

    use InteractsWithQueue,
        SerializesModels;

    /** @var string */
    private $commandName;

    /**
     * コンストラクタ
     *
     * @param string $commandName
     */
    public function __construct($commandName)
    {
        $this->commandName = $commandName;
    }

    /**
     * キューから取り出した時に実行
     */
    public function handle()
    {
        Artisan::call($this->commandName);
    }

}
