<?php

namespace Tests\Infrastructure\Rating\Builder;

use App\Domain\Rating\RatingCount\Rating;
use App\Domain\Rating\RatingCount\FacebookCount;
use App\Domain\Rating\RatingCount\GooglePlusCount;
use App\Domain\Rating\RatingCount\HatenaBookmarkCount;
use App\Domain\Rating\RatingCount\PocketCount;
use App\Domain\Rating\RatingCount\TwitterCount;
use App\Infrastructure\Rating\Builder\RatingBuilder;
use PHPUnit_Framework_TestCase;

class RatingBuilderTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function build_正常系()
    {
        // 実行
        $actual = RatingBuilder::builder()
                ->setHatenaBookmarkCount(1)
                ->setTwitterCount(2)
                ->setFacebookCount(3)
                ->setGooglePlusCount(4)
                ->setPocketCount(5)
                ->build();

        // 確認
        $expected = new Rating(
                new HatenaBookmarkCount(1),
                new TwitterCount(2),
                new FacebookCount(3),
                new GooglePlusCount(4),
                new PocketCount(5)
                );
        $this->assertEquals($expected, $actual);
    }

}
