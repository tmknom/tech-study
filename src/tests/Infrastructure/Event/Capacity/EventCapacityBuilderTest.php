<?php

namespace Tests\Infrastructure\Event\Capacity;

use App\Domain\Event\Capacity\Accepted;
use App\Domain\Event\Capacity\CapacityLimit;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Capacity\Waiting;
use App\Infrastructure\Event\Capacity\EventCapacityBuilder;
use PHPUnit_Framework_TestCase;

class EventCapacityBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventCapacityBuilder::builder()
                ->setCapacityLimit(1)
                ->setAccepted(2)
                ->setWaiting(3)
                ->build();

        // 確認
        $expected = new EventCapacity(
                new CapacityLimit(1), new Accepted(2), new Waiting(3)
        );
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function build_正常系_空文字があった場合()
    {
        // 実行
        $actual = EventCapacityBuilder::builder()
                ->setCapacityLimit('')
                ->setAccepted(null)
                ->setWaiting(0)
                ->build();

        // 確認
        $expected = new EventCapacity(
                new CapacityLimit(0), new Accepted(0), new Waiting(0)
        );
        $this->assertEquals($expected, $actual);
    }

}
