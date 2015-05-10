<?php

namespace App\Domain\Event\Core;

use App\Library\Domain\DateTimeValueObject;
use DateTimeImmutable;

class StartDateTime
{

    use DateTimeValueObject;

    /**
     * Y-m-d H:i:s形式にフォーマットした文字列を取得する
     *
     * @return string
     */
    public function formatDateTime()
    {
        return $this->getValue()->format('Y-m-d H:i:s');
    }

    /**
     * 開始日が一年以内かどうか判定する
     *
     * @return boolean 一年以内だったらtrue、そうでなければfalse
     */
    public function isWithinOneYear()
    {
        if ($this->getValue() < new DateTimeImmutable('+1 year')) {
            return true;
        }
        return false;
    }

}
