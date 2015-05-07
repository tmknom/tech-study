<?php

namespace App\Providers;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\AtndCrawler;
use App\Domain\EventCrawler\ConnpassCrawler;
use App\Domain\EventUrlList\EventUrlListRepository;
use App\Domain\SocialCrawler\TwitterCountCrawler;
use App\Infrastructure\Event\DbEventRepository;
use App\Infrastructure\EventCrawler\RestAtndCrawler;
use App\Infrastructure\EventCrawler\RestConnpassCrawler;
use App\Infrastructure\EventUrlList\DbEventUrlListRepository;
use App\Infrastructure\SocialCrawler\RestTwitterCountCrawler;
use Illuminate\Support\ServiceProvider;

/**
 * Domain層のサービスプロバイダー
 */
class DomainServiceProvider extends ServiceProvider
{

    /**
     * コンテナへの結合を登録する
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindif(EventRepository::class, DbEventRepository::class);
        $this->app->bindif(EventUrlListRepository::class, DbEventUrlListRepository::class);

        $this->app->bindif(AtndCrawler::class, RestAtndCrawler::class);
        $this->app->bindif(ConnpassCrawler::class, RestConnpassCrawler::class);

        $this->app->bindif(TwitterCountCrawler::class, RestTwitterCountCrawler::class);
    }

    /**
     * サービス起動の登録後に、実行される
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
