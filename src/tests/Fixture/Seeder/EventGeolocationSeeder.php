<?php

namespace Tests\Fixture\Seeder;

use App\Infrastructure\Event\ORMapper\EventGeolocationORMapper;
use DB;
use Illuminate\Database\Seeder;
use Tests\Fixture\Builder\TestEventBuilder;

class EventGeolocationSeeder extends Seeder
{

    public function run()
    {
        $eventGeolocation = TestEventBuilder::builder()->build()->getEventGeolocation();
        $defaultValue = array(
            'event_id' => 1,
            'region_code' => '1', // todo あとでちゃんとやる
            'prefecture_code' => '1',
            'address' => $eventGeolocation->getAddress(),
            'place' => $eventGeolocation->getPlace(),
            'latitude' => $eventGeolocation->getLatitude(),
            'longitude' => $eventGeolocation->getLongitude(),
        );
        DB::table(EventGeolocationORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
