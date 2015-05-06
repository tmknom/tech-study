<?php

namespace Tests\Fixture\Seeder;

use App\Infrastructure\Event\ORMapper\EventORMapper;
use DB;
use Illuminate\Database\Seeder;
use Tests\Infrastructure\Event\TestEventBuilder;

class EventSeeder extends Seeder
{

    public function run()
    {
        $event = TestEventBuilder::builder()->build();
        $defaultValue = array(
            'id' => 1,
            'url' => $event->getEventCore()->getEventUrl()->getValue(),
            'title' => $event->getEventCore()->getEventTitle()->getValue(),
            'start_date_time' => $event->getEventCore()->getStartDateTime()->formatDateTime(),
            'source_type' => $event->getEventCore()->getSourceType()->getValue(),
            'source_event_id' => $event->getEventDetail()->getSourceEventId()->getValue(),
            'description' => $event->getEventDetail()->getEventDescription()->getValue(),
            'catch_copy' => $event->getEventDetail()->getCatchCopy()->getValue(),
            'owner_id' => $event->getEventDetail()->getOwnerId()->getValue(),
        );
        DB::table(EventORMapper::TABLE_NAME)->insert($defaultValue);
    }

}
