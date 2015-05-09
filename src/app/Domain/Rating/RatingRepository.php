<?php

namespace App\Domain\Rating;

use App\Domain\Event\Core\EventUrl;

interface RatingRepository
{

    /**
     * 評価値保存
     *
     * @param EventUrl $eventUrl
     * @param mixed $ratingCount
     * @return RatingCount
     */
    public function save(EventUrl $eventUrl, $ratingCount);

}
