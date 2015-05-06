<?php

namespace App\Domain\Event\Area;

use App\Library\Domain\ValueObject;

/**
 * 地域区分コード（八地方区分）
 *
 * コード体系は独自
 */
class RegionCode
{

    use ValueObject;

    const UNDEFINED = 0;

    /** @var int */
    private $value;

    /*
      private $codeArray = array(
      "0" => "未定義",
      "1" => "北海道",
      "2" => "東北",
      "3" => "関東",
      "4" => "中部",
      "5" => "近畿",
      "6" => "中国",
      "7" => "四国",
      "8" => "九州",
      );
     */

}
