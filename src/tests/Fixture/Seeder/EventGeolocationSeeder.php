<?php

namespace Tests\Fixture\Seeder;

use App\Infrastructure\Event\ORMapper\EventGeolocationORMapper;
use DB;
use Illuminate\Database\Seeder;
use Tests\Infrastructure\Event\TestEventBuilder;

class EventGeolocationSeeder extends Seeder
{

    public function run()
    {
        $eventGeolocation = TestEventBuilder::builder()->build()->getEventGeolocation();
        $defaultValue = array(
            'event_id' => 1,
            'region_code' => '1', // todo あとでちゃんとやる
            'prefecture_code' => '1',
            'address' => $eventGeolocation->getAddress()->getValue(),
            'place' => $eventGeolocation->getPlace()->getValue(),
            'latitude' => $eventGeolocation->getLatitude()->getValue(),
            'longitude' => $eventGeolocation->getLongitude()->getValue(),
        );
        DB::table(EventGeolocationORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
