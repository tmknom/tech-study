<?php

namespace Tests\Infrastructure\Event\Builder;

use App\Domain\Event\Rating\EventRating;
use App\Domain\Event\Rating\FacebookCount;
use App\Domain\Event\Rating\GooglePlusCount;
use App\Domain\Event\Rating\HatenaBookmarkCount;
use App\Domain\Event\Rating\PocketCount;
use App\Domain\Event\Rating\TwitterCount;
use App\Infrastructure\Event\Builder\EventRatingBuilder;
use PHPUnit_Framework_TestCase;

class EventRatingBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = EventRatingBuilder::builder()
                ->setHatenaBookmarkCount(1)
                ->setTwitterCount(2)
                ->setFacebookCount(3)
                ->setGooglePlusCount(4)
                ->setPocketCount(5)
                ->build();

        // 確認
        $expected = new EventRating(
                new HatenaBookmarkCount(1),
                new TwitterCount(2),
                new FacebookCount(3),
                new GooglePlusCount(4),
                new PocketCount(5)
                );
        $this->assertEquals($expected, $actual);
    }

}
