<?php

namespace App\Domain\Event\Geolocation;

use App\Library\Domain\Aggregate;

class EventGeolocation
{

    use Aggregate;

    /** @var Address */
    private $address;

    /** @var Place */
    private $place;

    /** @var Latitude */
    private $latitude;

    /** @var Longitude */
    private $longitude;

    public function __construct(Address $address, Place $place, Latitude $latitude,
                                Longitude $longitude)
    {

        $this->completeConstruct(func_get_args());
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return Latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return Longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return Place
     */
    public function getPlace()
    {
        return $this->place;
    }

}
