<?php

namespace App\Providers;

use App\Domain\EventCrawler\AtndCrawler;
use App\Infrastructure\EventCrawler\RestAtndCrawler;
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
        $this->app->bindif(AtndCrawler::class, RestAtndCrawler::class);
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
