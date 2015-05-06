<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    /** @before */
    public function setUp()
    {
        parent::setUp();

        $this->setUpDb();
    }

    /** @after */
    public function tearDown()
    {
        Mockery::close();
        $this->tearDownDb();

        parent::tearDown();
    }

    /** DBの準備 */
    private function setUpDb()
    {
        // テーブル作成
        Artisan::call('migrate');
    }

    /** DBの後始末 */
    private function tearDownDb()
    {
        // テーブル削除
        Artisan::call('migrate:reset');
        // DB切断
        DB::disconnect();
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

}
