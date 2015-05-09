<?php

namespace App\Providers;

use App\Domain\Event\EventRepository;
use App\Domain\EventCrawler\AtndCrawler;
use App\Domain\EventCrawler\ConnpassCrawler;
use App\Domain\EventUrlList\EventUrlListRepository;
use App\Domain\Rating\Repository\FacebookRatingRepository;
use App\Domain\Rating\Repository\HatenaBookmarkRatingRepository;
use App\Domain\Rating\Repository\TwitterRatingRepository;
use App\Domain\SocialCrawler\FacebookCountCrawler;
use App\Domain\SocialCrawler\HatenaBookmarkCountCrawler;
use App\Domain\SocialCrawler\TwitterCountCrawler;
use App\Infrastructure\Event\DbEventRepository;
use App\Infrastructure\EventCrawler\RestAtndCrawler;
use App\Infrastructure\EventCrawler\RestConnpassCrawler;
use App\Infrastructure\EventUrlList\DbEventUrlListRepository;
use App\Infrastructure\Rating\Repository\DbFacebookRatingRepository;
use App\Infrastructure\Rating\Repository\DbHatenaBookmarkRatingRepository;
use App\Infrastructure\Rating\Repository\DbTwitterRatingRepository;
use App\Infrastructure\SocialCrawler\RestFacebookCountCrawler;
use App\Infrastructure\SocialCrawler\RestHatenaBookmarkCountCrawler;
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

        $this->app->bindif(TwitterRatingRepository::class, DbTwitterRatingRepository::class);
        $this->app->bindif(FacebookRatingRepository::class, DbFacebookRatingRepository::class);
        $this->app->bindif(HatenaBookmarkRatingRepository::class, DbHatenaBookmarkRatingRepository::class);

        $this->app->bindif(AtndCrawler::class, RestAtndCrawler::class);
        $this->app->bindif(ConnpassCrawler::class, RestConnpassCrawler::class);

        $this->app->bindif(TwitterCountCrawler::class, RestTwitterCountCrawler::class);
        $this->app->bindif(FacebookCountCrawler::class, RestFacebookCountCrawler::class);
        $this->app->bindif(HatenaBookmarkCountCrawler::class, RestHatenaBookmarkCountCrawler::class);
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
