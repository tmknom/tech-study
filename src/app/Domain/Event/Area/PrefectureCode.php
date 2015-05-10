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

    public function getName()
    {
        return $this->codeMap[$this->getValue()];
    }

    public function getCode()
    {
        return $this->getValue();
    }

    private $codeMap = array(
        "0" => "未定義",
        "1" => "北海道",
        "2" => "青森県",
        "3" => "岩手県",
        "4" => "宮城県",
        "5" => "秋田県",
        "6" => "山形県",
        "7" => "福島県",
        "8" => "茨城県",
        "9" => "栃木県",
        "10" => "群馬県",
        "11" => "埼玉県",
        "12" => "千葉県",
        "13" => "東京都",
        "14" => "神奈川県",
        "15" => "新潟県",
        "16" => "富山県",
        "17" => "石川県",
        "18" => "福井県",
        "19" => "山梨県",
        "20" => "長野県",
        "21" => "岐阜県",
        "22" => "静岡県",
        "23" => "愛知県",
        "24" => "三重県",
        "25" => "滋賀県",
        "26" => "京都府",
        "27" => "大阪府",
        "28" => "兵庫県",
        "29" => "奈良県",
        "30" => "和歌山県",
        "31" => "鳥取県",
        "32" => "島根県",
        "33" => "岡山県",
        "34" => "広島県",
        "35" => "山口県",
        "36" => "徳島県",
        "37" => "香川県",
        "38" => "愛媛県",
        "39" => "高知県",
        "40" => "福岡県",
        "41" => "佐賀県",
        "42" => "長崎県",
        "43" => "熊本県",
        "44" => "大分県",
        "45" => "宮崎県",
        "46" => "鹿児島県",
        "47" => "沖縄県"
    );

}
