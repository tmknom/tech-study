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
    public function dbExample()
    {
        // 実行
        $insertArray = array(
            'name' => '森鴎外',
            'email' => 'hoge@example.com',
            'password' => 'new_password',
        );
        $id = DB::table('users')->insertGetId($insertArray);

        // 確認
        $result = DB::table('users')->where('id', '=', $id)->first();
        $this->assertEquals('森鴎外', $result->name);
    }

    /** @test */
    public function environment()
    {
        $this->assertEquals('testing', App::environment());
        //$this->assertEquals(array(), $_ENV);
    }

}
