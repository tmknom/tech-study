<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Geolocation\Address;
use App\Domain\Event\Geolocation\EventGeolocation;
use App\Domain\Event\Geolocation\Latitude;
use App\Domain\Event\Geolocation\Longitude;
use App\Domain\Event\Geolocation\Place;

class EventGeolocationBuilder
{

    /** @var Address */
    private $address;

    /** @var Place */
    private $place;

    /** @var Latitude */
    private $latitude;

    /** @var Longitude */
    private $longitude;

    /** @return EventGeolocationBuilder */
    public function setAddress($value)
    {
        $this->address = new Address($this->getValueOrEmpty($value));
        return $this;
    }

    /** @return EventGeolocationBuilder */
    public function setPlace($value)
    {
        $this->place = new Place($this->getValueOrEmpty($value));
        return $this;
    }

    /** @return EventGeolocationBuilder */
    public function setLatitude($value)
    {
        $this->latitude = new Latitude($this->getValueOrNull($value));
        return $this;
    }

    /** @return EventGeolocationBuilder */
    public function setLongitude($value)
    {
        $this->longitude = new Longitude($this->getValueOrNull($value));
        return $this;
    }

    /** @return EventGeolocation */
    public function build()
    {
        return new EventGeolocation(
                $this->address, $this->place, $this->latitude, $this->longitude
        );
    }

    private function getValueOrEmpty($value)
    {
        return empty($value) ? '' : $value;
    }

    private function getValueOrNull($value)
    {
        return empty($value) ? null : $value;
    }

    /** @return EventGeolocationBuilder */
    public static function builder()
    {
        return new EventGeolocationBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
