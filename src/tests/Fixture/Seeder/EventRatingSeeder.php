<?php

namespace Tests\Fixture\Seeder;

use App\Infrastructure\Event\ORMapper\EventRatingORMapper;
use DB;
use Illuminate\Database\Seeder;
use Tests\Fixture\Builder\TestEventBuilder;

class EventRatingSeeder extends Seeder
{

    public function run()
    {
        $eventRating = TestEventBuilder::builder()->build()->getEventRating();
        $defaultValue = array(
            'event_id' => 1,
            'hatena_bookmark_count' => $eventRating->getHatenaBookmarkCount(),
            'twitter_count' => $eventRating->getTwitterCount(),
            'facebook_count' => $eventRating->getFacebookCount(),
            'google_plus_count' => $eventRating->getGooglePlusCount(),
            'pocket_count' => $eventRating->getPocketCount(),
        );
        DB::table(EventRatingORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
