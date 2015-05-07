<?php

namespace App\Infrastructure\Event\Builder;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Area\PrefectureCode;
use App\Domain\Event\Area\RegionCode;

class EventAreaBuilder
{

    /** @var PrefectureCode */
    private $prefectureCode;

    /** @var RegionCode */
    private $regionCode;

    /** @return EventAreaBuilder */
    public function setPrefectureCode($value)
    {
        $this->prefectureCode = new PrefectureCode($value);
        return $this;
    }

    /** @return EventAreaBuilder */
    public function setRegionCode($value)
    {
        $this->regionCode = new RegionCode($value);
        return $this;
    }

    /** @return EventArea */
    public function build()
    {
        return new EventArea(
                $this->prefectureCode, $this->regionCode
        );
    }

    /** @return EventAreaBuilder */
    public static function builder()
    {
        return new EventAreaBuilder();
    }

    /** コンストラクタ */
    private function __construct()
    {
        
    }

}
