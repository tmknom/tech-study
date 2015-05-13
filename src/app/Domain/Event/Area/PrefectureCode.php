<?php

namespace App\Domain\Event\Area;

use App\Library\Fundamental\Enum;

/**
 * 都道府県コード
 *
 * ISO 3166-2:JPに準拠
 * 参考URL：http://ja.wikipedia.org/wiki/ISO_3166-2:JP
 */
class PrefectureCode
{

    use Enum;

    const UNDEFINED = 0;
    const HOKKAIDO = 1;
    const AOMORI = 2;
    const IWATE = 3;
    const MIYAGI = 4;
    const AKITA = 5;
    const YAMAGATA = 6;
    const FUKUSHIMA = 7;
    const IBARAKI = 8;
    const TOCHIGI = 9;
    const GUNMA = 10;
    const SAITAMA = 11;
    const CHIBA = 12;
    const TOKYO = 13;
    const KANAGAWA = 14;
    const NIIGATA = 15;
    const TOYAMA = 16;
    const ISHIKAWA = 17;
    const FUKUI = 18;
    const YAMANASHI = 19;
    const NAGANO = 20;
    const GIFU = 21;
    const SHIZUOKA = 22;
    const AICHI = 23;
    const MIE = 24;
    const SHIGA = 25;
    const KYOTO = 26;
    const OSAKA = 27;
    const HYOGO = 28;
    const NARA = 29;
    const WAKAYAMA = 30;
    const TOTTORI = 31;
    const SHIMANE = 32;
    const OKAYAMA = 33;
    const HIROSHIMA = 34;
    const YAMAGUCHI = 35;
    const TOKUSHIMA = 36;
    const KAGAWA = 37;
    const EHIME = 38;
    const KOCHI = 39;
    const FUKUOKA = 40;
    const SAGA = 41;
    const NAGASAKI = 42;
    const KUMAMOTO = 43;
    const OITA = 44;
    const MIYAZAKI = 45;
    const KAGOSHIMA = 46;
    const OKINAWA = 47;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->codeMap()[$this->getValue()]['name'];
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->getValue();
    }

    /**
     * @return RegionCode
     */
    public function getRegionCode()
    {
        return new RegionCode($this->codeMap()[$this->getValue()]['region_code']);
    }

    private function codeMap()
    {
        return array(
            '0' => array('name' => "未定義", 'region_code' => RegionCode::UNDEFINED),
            '1' => array('name' => '北海道', 'region_code' => RegionCode::HOKKAIDO),
            '2' => array('name' => '青森県', 'region_code' => RegionCode::TOHOKU),
            '3' => array('name' => '岩手県', 'region_code' => RegionCode::TOHOKU),
            '4' => array('name' => '宮城県', 'region_code' => RegionCode::TOHOKU),
            '5' => array('name' => '秋田県', 'region_code' => RegionCode::TOHOKU),
            '6' => array('name' => '山形県', 'region_code' => RegionCode::TOHOKU),
            '7' => array('name' => '福島県', 'region_code' => RegionCode::TOHOKU),
            '8' => array('name' => '茨城県', 'region_code' => RegionCode::KANTO),
            '9' => array('name' => '栃木県', 'region_code' => RegionCode::KANTO),
            '10' => array('name' => '群馬県', 'region_code' => RegionCode::KANTO),
            '11' => array('name' => '埼玉県', 'region_code' => RegionCode::KANTO),
            '12' => array('name' => '千葉県', 'region_code' => RegionCode::KANTO),
            '13' => array('name' => '東京都', 'region_code' => RegionCode::KANTO),
            '14' => array('name' => '神奈川県', 'region_code' => RegionCode::KANTO),
            '15' => array('name' => '新潟県', 'region_code' => RegionCode::CHUBU),
            '16' => array('name' => '富山県', 'region_code' => RegionCode::CHUBU),
            '17' => array('name' => '石川県', 'region_code' => RegionCode::CHUBU),
            '18' => array('name' => '福井県', 'region_code' => RegionCode::CHUBU),
            '19' => array('name' => '山梨県', 'region_code' => RegionCode::CHUBU),
            '20' => array('name' => '長野県', 'region_code' => RegionCode::CHUBU),
            '21' => array('name' => '岐阜県', 'region_code' => RegionCode::CHUBU),
            '22' => array('name' => '静岡県', 'region_code' => RegionCode::CHUBU),
            '23' => array('name' => '愛知県', 'region_code' => RegionCode::CHUBU),
            '24' => array('name' => '三重県', 'region_code' => RegionCode::KINKI),
            '25' => array('name' => '滋賀県', 'region_code' => RegionCode::KINKI),
            '26' => array('name' => '京都府', 'region_code' => RegionCode::KINKI),
            '27' => array('name' => '大阪府', 'region_code' => RegionCode::KINKI),
            '28' => array('name' => '兵庫県', 'region_code' => RegionCode::KINKI),
            '29' => array('name' => '奈良県', 'region_code' => RegionCode::KINKI),
            '30' => array('name' => '和歌山県', 'region_code' => RegionCode::KINKI),
            '31' => array('name' => '鳥取県', 'region_code' => RegionCode::CHUGOKU),
            '32' => array('name' => '島根県', 'region_code' => RegionCode::CHUGOKU),
            '33' => array('name' => '岡山県', 'region_code' => RegionCode::CHUGOKU),
            '34' => array('name' => '広島県', 'region_code' => RegionCode::CHUGOKU),
            '35' => array('name' => '山口県', 'region_code' => RegionCode::CHUGOKU),
            '36' => array('name' => '徳島県', 'region_code' => RegionCode::SHIKOKU),
            '37' => array('name' => '香川県', 'region_code' => RegionCode::SHIKOKU),
            '38' => array('name' => '愛媛県', 'region_code' => RegionCode::SHIKOKU),
            '39' => array('name' => '高知県', 'region_code' => RegionCode::SHIKOKU),
            '40' => array('name' => '福岡県', 'region_code' => RegionCode::KYUSHU),
            '41' => array('name' => '佐賀県', 'region_code' => RegionCode::KYUSHU),
            '42' => array('name' => '長崎県', 'region_code' => RegionCode::KYUSHU),
            '43' => array('name' => '熊本県', 'region_code' => RegionCode::KYUSHU),
            '44' => array('name' => '大分県', 'region_code' => RegionCode::KYUSHU),
            '45' => array('name' => '宮崎県', 'region_code' => RegionCode::KYUSHU),
            '46' => array('name' => '鹿児島県', 'region_code' => RegionCode::KYUSHU),
            '47' => array('name' => '沖縄県', 'region_code' => RegionCode::KYUSHU),
        );
    }

}
