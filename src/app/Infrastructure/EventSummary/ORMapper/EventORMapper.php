<?php

namespace App\Infrastructure\EventSummary\ORMapper;

use App\Domain\Event\Area\EventArea;
use App\Domain\Event\Capacity\EventCapacity;
use App\Domain\Event\Core\EventCore;
use App\Domain\EventSummary\EventSummary;
use App\Domain\EventSummary\EventSummaryList;
use App\Domain\Rating\Rating;
use App\Infrastructure\Event\Builder\EventAreaBuilder;
use App\Infrastructure\Event\Builder\EventCapacityBuilder;
use App\Infrastructure\Event\Builder\EventCoreBuilder;
use App\Infrastructure\Event\ORMapper\EventCapacityORMapper;
use App\Infrastructure\Event\ORMapper\EventGeolocationORMapper;
use App\Infrastructure\EventSummary\Builder\EventSummaryBuilder;
use App\Infrastructure\Rating\Builder\RatingBuilder;
use App\Infrastructure\Rating\Repository\ORMapper\EventRatingORMapper;
use DateTimeImmutable;
use DB;
use Illuminate\Database\Query\Builder;

class EventORMapper
{

    const TABLE_NAME = 'event';

    public function listRecent()
    {
        $dbArrayList = $this->selectBuilder()
                ->select($this->columnList())
                ->orderBy('created_at', 'desc')
                ->take(30)
                ->get();

        return $this->createEventSummaryList($dbArrayList);
    }

    /**
     * @param array $dbArrayList
     * @return EventSummaryList
     */
    private function createEventSummaryList(array $dbArrayList)
    {
        $result = array();
        foreach ($dbArrayList as $dbArray) {
            $event = $this->createEventSummary((array) $dbArray);
            array_push($result, $event);
        }
        return new EventSummaryList($result);
    }

    /**
     * @param array $dbArray
     * @return EventSummary
     */
    private function createEventSummary(array $dbArray)
    {
        return EventSummaryBuilder::builder()
                        ->setEventId($dbArray['id'])
                        ->setEventCore($this->createEventCore($dbArray))
                        ->setEventCapacity($this->createEventCapacity($dbArray))
                        ->setRating($this->createRating($dbArray))
                        ->setEventArea($this->createEventArea($dbArray))
                        ->build();
    }

    /**
     * @param array $dbArray
     * @return EventCore
     */
    protected function createEventCore(array $dbArray)
    {
        return EventCoreBuilder::builder()
                        ->setEventTitle($dbArray['title'])
                        ->setEventUrl($dbArray['url'])
                        ->setStartDateTime(new DateTimeImmutable($dbArray['start_date_time']))
                        ->setSourceType($dbArray['source_type'])
                        ->build();
    }

    /**
     * @param array $dbArray
     * @return Rating
     */
    private function createRating(array $dbArray)
    {
        return RatingBuilder::builder()
                        ->setHatenaBookmarkCount($dbArray['hatena_bookmark_count'])
                        ->setTwitterCount($dbArray['twitter_count'])
                        ->setFacebookCount($dbArray['facebook_count'])
                        ->setGooglePlusCount($dbArray['google_plus_count'])
                        ->setPocketCount($dbArray['pocket_count'])
                        ->build();
    }

    /**
     * @param array $dbArray
     * @return EventCapacity
     */
    protected function createEventCapacity(array $dbArray)
    {
        return EventCapacityBuilder::builder()
                        ->setCapacityLimit($dbArray['capacity_limit'])
                        ->setAccepted($dbArray['accepted'])
                        ->setWaiting($dbArray['waiting'])
                        ->build();
    }

    /**
     * @param array $dbArray
     * @return EventArea
     */
    private function createEventArea(array $dbArray)
    {
        return EventAreaBuilder::builder()
                        ->setRegionCode($dbArray['region_code'])
                        ->setPrefectureCode($dbArray['prefecture_code'])
                        ->build();
    }

    /**
     * @return Builder
     */
    private function selectBuilder()
    {
        return DB::table(self::TABLE_NAME)
                        ->join(EventRatingORMapper::TABLE_NAME, self::TABLE_NAME . '.id', '=',
                               EventRatingORMapper::TABLE_NAME . '.event_id')
                        ->join(EventCapacityORMapper::TABLE_NAME, self::TABLE_NAME . '.id', '=',
                               EventCapacityORMapper::TABLE_NAME . '.event_id')
                        ->join(EventGeolocationORMapper::TABLE_NAME, self::TABLE_NAME . '.id', '=',
                               EventGeolocationORMapper::TABLE_NAME . '.event_id')
                        ->select($this->columnList());
    }

    /**
     * @return array
     */
    private function columnList()
    {
        return array(
            'id',
            'title',
            'url',
            'start_date_time',
            'source_type',
            'region_code',
            'prefecture_code',
            'capacity_limit',
            'accepted',
            'waiting',
            'hatena_bookmark_count',
            'twitter_count',
            'facebook_count',
            'google_plus_count',
            'pocket_count'
        );
    }

}
