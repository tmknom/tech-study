<?php

namespace Tests\Fixture\Seeder;

use App\Infrastructure\Event\ORMapper\EventCapacityORMapper;
use DB;
use Illuminate\Database\Seeder;
use Tests\Fixture\Builder\TestEventBuilder;

class EventCapacitySeeder extends Seeder
{

    public function run()
    {
        $eventCapacity = TestEventBuilder::builder()->build()->getEventCapacity();
        $defaultValue = array(
            'event_id' => 1,
            'capacity_limit' => $eventCapacity->getCapacityLimit()->getValue(),
            'accepted' => $eventCapacity->getAccepted()->getValue(),
            'waiting' => $eventCapacity->getWaiting()->getValue(),
        );
        DB::table(EventCapacityORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
