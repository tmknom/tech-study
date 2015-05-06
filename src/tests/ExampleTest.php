<?php

class ExampleTest extends TestCase
{

    /** @test */
    public function testBasicExample()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        //$this->assertEquals(true, false);
    }

    /** @test */
    public function environment()
    {
        $this->assertEquals('testing', App::environment());
        //$this->assertEquals(array(), $_ENV);
    }

}
