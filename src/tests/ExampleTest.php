<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$response = $this->call('GET', '/');

		$this->assertEquals(200, $response->getStatusCode());
	}

    public function testDbExample()
    {
        // テーブル作成
        Artisan::call('migrate');

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

        // テーブル削除
        Artisan::call('migrate:reset');
        // DB切断
        DB::disconnect();
    }

    /** @test */
    public function environment()
    {
        $this->assertEquals('testing', App::environment());
        //$this->assertEquals(array(), $_ENV);
    }

}
