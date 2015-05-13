<?php

namespace App\Domain\Event\Area;

use App\Library\Fundamental\Enum;

/**
 * 地域区分コード（八地方区分）
 *
 * コード体系は独自
 */
class RegionCode
{

    use Enum;

    const UNDEFINED = 0;
    const HOKKAIDO = 1;
    const TOHOKU = 2;
    const KANTO = 3;
    const CHUBU = 4;
    const KINKI = 5;
    const CHUGOKU = 6;
    const SHIKOKU = 7;
    const KYUSHU = 8;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->codeMap()[$this->getValue()];
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->getValue();
    }

    private function codeMap()
    {
        return array(
            '0' => '未定義',
            '1' => '北海道',
            '2' => '東北',
            '3' => '関東',
            '4' => '中部',
            '5' => '近畿',
            '6' => '中国',
            '7' => '四国',
            '8' => '九州',
        );
    }

}
