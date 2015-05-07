<?php

namespace App\Providers;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\AtndCrawler;
use App\Domain\EventCrawler\ConnpassCrawler;
use App\Infrastructure\Event\DbEventRepository;
use App\Infrastructure\EventCrawler\RestAtndCrawler;
use App\Infrastructure\EventCrawler\RestConnpassCrawler;
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

        $this->app->bindif(AtndCrawler::class, RestAtndCrawler::class);
        $this->app->bindif(ConnpassCrawler::class, RestConnpassCrawler::class);
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
