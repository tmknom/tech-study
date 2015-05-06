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
            'hatena_bookmark_count' => $eventRating->getHatenaBookmarkCount()->getValue(),
            'twitter_count' => $eventRating->getTwitterCount()->getValue(),
            'facebook_count' => $eventRating->getFacebookCount()->getValue(),
            'google_plus_count' => $eventRating->getGooglePlusCount()->getValue(),
            'pocket_count' => $eventRating->getPocketCount()->getValue(),
        );
        DB::table(EventRatingORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
