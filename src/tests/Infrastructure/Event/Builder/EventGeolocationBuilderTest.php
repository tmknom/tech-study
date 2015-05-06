<?php

namespace Tests\Infrastructure\Event\Builder;

use App\Domain\Event\Geolocation\Address;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Event\Geolocation\Latitude;
use App\Domain\Event\Geolocation\Longitude;
use App\Domain\Event\Geolocation\Place;
use App\Infrastructure\Event\Builder\EventGeolocationBuilder;
use PHPUnit_Framework_TestCase;

class EventGeolocationBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventGeolocationBuilder::builder()
                ->setAddress('address1')
                ->setPlace('plase1')
                ->setLatitude(2.1)
                ->setLongitude(3.3)
                ->build();

        // 確認
        $expected = new EventGeolocation(
                new Address('address1'),
                new Place('plase1'),
                new Latitude(2.1),
                new Longitude(3.3)
                );
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function build_正常系_空文字があった場合()
    {
        // 実行
        $actual = EventGeolocationBuilder::builder()
                ->setAddress(null)
                ->setPlace('')
                ->setLatitude(null)
                ->setLongitude('')
                ->build();

        // 確認
        $expected = new EventGeolocation(
                new Address(''),
                new Place(''),
                new Latitude(null),
                new Longitude(null)
                );
        $this->assertEquals($expected, $actual);
    }

}
