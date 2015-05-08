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
        $rating = TestEventBuilder::builder()->build()->getRating();
        $defaultValue = array(
            'event_id' => 1,
            'hatena_bookmark_count' => $rating->getHatenaBookmarkCount(),
            'twitter_count' => $rating->getTwitterCount(),
            'facebook_count' => $rating->getFacebookCount(),
            'google_plus_count' => $rating->getGooglePlusCount(),
            'pocket_count' => $rating->getPocketCount(),
        );
        DB::table(EventRatingORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
