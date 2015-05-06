<?php

namespace Tests\Infrastructure\Event\Detail;

use App\Domain\Event\Detail\CatchCopy;
use App\Domain\Event\Detail\EventDescription;
use App\Domain\Event\Detail\EventDetail;
use App\Domain\Event\Detail\OwnerId;
use App\Domain\Event\Detail\SourceEventId;
use App\Infrastructure\Event\Detail\EventDetailBuilder;
use PHPUnit_Framework_TestCase;

class EventDetailBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventDetailBuilder::builder()
                ->setCatchCopy('キャッチコピー1')
                ->setEventDescription('概要1')
                ->setOwnerId('owner1')
                ->setSourceEventId('source_id1')
                ->build();

        // 確認
        $expected = new EventDetail(
                new SourceEventId('source_id1'), 
                new EventDescription('概要1'),
                new CatchCopy('キャッチコピー1'),
                new OwnerId('owner1')
        );
        $this->assertEquals($expected, $actual);
    }

}
