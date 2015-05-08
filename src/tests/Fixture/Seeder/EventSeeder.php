<?php

namespace Tests\Fixture\Seeder;

use App\Infrastructure\Event\ORMapper\EventORMapper;
use DB;
use Illuminate\Database\Seeder;
use Tests\Fixture\Builder\TestEventBuilder;

class EventSeeder extends Seeder
{

    public function run()
    {
        $event = TestEventBuilder::builder()->build();
        $defaultValue = array(
            'id' => 1,
            'url' => $event->getEventCore()->getEventUrl(),
            'title' => $event->getEventCore()->getEventTitle(),
            'start_date_time' => $event->getEventCore()->getStartDateTime()->formatDateTime(),
            'source_type' => $event->getEventCore()->getSourceType(),
            'source_event_id' => $event->getEventDetail()->getSourceEventId(),
            'description' => $event->getEventDetail()->getEventDescription(),
            'catch_copy' => $event->getEventDetail()->getCatchCopy(),
            'owner_id' => $event->getEventDetail()->getOwnerId(),
        );
        DB::table(EventORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
