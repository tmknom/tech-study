<?php

namespace App\Commands;

use App;
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

    /** @var string */
    private $socialCrawlerApplicationClass;

    /** @var EventUrl */
    private $eventUrl;

    /**
     * コンストラクタ
     *
     * @param string $socialCrawlerApplicationClass
     * @param EventUrl $eventUrl
     */
    public function __construct($socialCrawlerApplicationClass, EventUrl $eventUrl)
    {
        $this->socialCrawlerApplicationClass = $socialCrawlerApplicationClass;
        $this->eventUrl = $eventUrl;
    }

    /**
     * キューから取り出した時に実行
     */
    public function handle()
    {
        $ratingCount = App::make($this->socialCrawlerApplicationClass)->crawl($this->eventUrl);
        $type = str_replace('CrawlerApplication', '',
                              array_slice(explode('\\', $this->socialCrawlerApplicationClass), -1)[0]);
        echo json_encode([
            'rate' => $ratingCount->__toString(),
            'url' => $this->eventUrl->__toString(),
            'type' => $type,
        ]) . PHP_EOL;
    }

}
