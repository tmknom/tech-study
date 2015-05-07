<?php

namespace App\Domain\Event\Area;

use App\Library\Domain\Aggregate;

/**
 * 地域
 */
class EventArea
{

    use Aggregate;

    /** @var PrefectureCode */
    private $prefectureCode;

    /** @var RegionCode */
    private $regionCode;

    /**
     * コンストラクタ
     *
     * @param PrefectureCode $prefectureCode
     * @param RegionCode $regionCode
     */
    public function __construct(PrefectureCode $prefectureCode, RegionCode $regionCode)
    {
        $this->completeConstruct(func_get_args());
    }

    /**
     * @return PrefectureCode
     */
    public function getPrefectureCode()
    {
        return $this->prefectureCode;
    }

    /**
     * @return RegionCode
     */
    public function getRegionCode()
    {
        return $this->regionCode;
    }

}
