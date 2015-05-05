<?php namespace App\Providers;

use App\Library\Http\GuzzleHttpClient;
use App\Library\Http\HttpClient;
use Illuminate\Support\ServiceProvider;

/**
 * Library層のサービスプロバイダー
 */
class LibraryServiceProvider extends ServiceProvider {

    /**
     * コンテナへの結合を登録する
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindif(HttpClient::class, GuzzleHttpClient::class);
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
