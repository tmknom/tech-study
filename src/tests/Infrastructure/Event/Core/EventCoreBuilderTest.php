<?php

namespace Tests\Infrastructure\Event\Capacity;

use App\Domain\Event\Core\EventCore;
use App\Domain\Event\Core\EventTitle;
use App\Domain\Event\Core\EventUrl;
use App\Domain\Event\Core\SourceType;
use App\Domain\Event\Core\StartDateTime;
use App\Infrastructure\Event\Core\EventCoreBuilder;
use PHPUnit_Framework_TestCase;

class EventCoreBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventCoreBuilder::builder()
                ->setEventTitle('タイトル1')
                ->setEventUrl('url1')
                ->setSourceType(SourceType::ATND)
                ->setStartDateTime('now')
                ->build();

        // 確認
        $expected = new EventCore(
                new EventTitle('タイトル1'),
                new EventUrl('url1'),
                new StartDateTime('now'),
                new SourceType('atnd')
                );
        $this->assertEquals($expected, $actual);
    }

}
