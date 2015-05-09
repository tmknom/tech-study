<?php

namespace App\Commands;

use App\Application\SocialCrawler\SocialCrawlerApplication;
use App\Commands\Command;
use App\Domain\Event\Core\EventUrl;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SocialCrawler extends Command implements SelfHandling, ShouldBeQueued
{

    use InteractsWithQueue,
        SerializesModels;

    /** @var SocialCrawlerApplication */
    private $socialCrawlerApplication;

    /** @var EventUrl */
    private $eventUrl;

    /**
     * コンストラクタ
     *
     * @param SocialCrawlerApplication $socialCrawlerApplication
     * @param EventUrl $eventUrl
     */
    public function __construct(SocialCrawlerApplication $socialCrawlerApplication, EventUrl $eventUrl)
    {
        $this->socialCrawlerApplication = $socialCrawlerApplication;
        $this->eventUrl = $eventUrl;
    }

    /**
     * キューから取り出した時に実行
     */
    public function handle()
    {
        $this->socialCrawlerApplication->crawl($this->eventUrl);
    }

}
