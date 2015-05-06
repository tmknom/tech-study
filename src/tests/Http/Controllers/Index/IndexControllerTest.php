<?php

namespace Tests\Http\Controllers\Index;

use Tests\Base\TestCase;

class IndexControllerTest extends TestCase
{

    /** @test */
    public function 参照系のテスト()
    {
        $response = $this->call('GET', '/');
        $this->assertTrue($response->isOk());
        $this->assertEquals('["hello, world!"]', $response->getContent());
    }

}
