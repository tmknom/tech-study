<?php

namespace App\Providers;

use App\Application\EventCrawler\AtndCrawlerApplication;
use App\Application\EventCrawler\ConnpassCrawlerApplication;
use App\Application\EventCrawler\DoorkeeperCrawlerApplication;
use App\Application\EventCrawler\PartakeCrawlerApplication;
use App\Application\EventCrawler\ZusaarCrawlerApplication;
use App\Application\EventUrlListReference\EventUrlListReferenceApplication;
use App\Application\SocialCrawler\FacebookCrawlerApplication;
use App\Application\SocialCrawler\GooglePlusCrawlerApplication;
use App\Application\SocialCrawler\HatenaBookmarkCrawlerApplication;
use App\Application\SocialCrawler\PocketCrawlerApplication;
use App\Application\SocialCrawler\TwitterCrawlerApplication;
use Illuminate\Support\ServiceProvider;

/**
 * Application層のサービスプロバイダー
 */
class ApplicationServiceProvider extends ServiceProvider
{

    /**
     * コンテナへの結合を登録する
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindif(AtndCrawlerApplication::class, AtndCrawlerApplication::class);
        $this->app->bindif(ConnpassCrawlerApplication::class, ConnpassCrawlerApplication::class);
        $this->app->bindif(DoorkeeperCrawlerApplication::class, DoorkeeperCrawlerApplication::class);
        $this->app->bindif(ZusaarCrawlerApplication::class, ZusaarCrawlerApplication::class);
        $this->app->bindif(PartakeCrawlerApplication::class, PartakeCrawlerApplication::class);

        $this->app->bindif(TwitterCrawlerApplication::class, TwitterCrawlerApplication::class);
        $this->app->bindif(FacebookCrawlerApplication::class, FacebookCrawlerApplication::class);
        $this->app->bindif(HatenaBookmarkCrawlerApplication::class, HatenaBookmarkCrawlerApplication::class);
        $this->app->bindif(PocketCrawlerApplication::class, PocketCrawlerApplication::class);
        $this->app->bindif(GooglePlusCrawlerApplication::class, GooglePlusCrawlerApplication::class);

        $this->app->bindif(EventUrlListReferenceApplication::class, EventUrlListReferenceApplication::class);
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
