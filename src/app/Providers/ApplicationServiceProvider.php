<?php namespace App\Providers;

use App\Application\EventCrawler\SampleCrawlerApplication;
use Illuminate\Support\ServiceProvider;

/**
 * Application層のサービスプロバイダー
 */
class ApplicationServiceProvider extends ServiceProvider {

    /**
     * コンテナへの結合を登録する
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindif(SampleCrawlerApplication::class, SampleCrawlerApplication::class);
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
