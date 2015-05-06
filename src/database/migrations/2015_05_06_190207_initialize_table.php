<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * php artisan migrate
 * php artisan migrate:reset
 *
 * mysql -u app_user -ppassword app_db
 */
class InitializeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event',
                       function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url', 128);
            $table->string('title', 128);
            $table->dateTime('start_date_time');
            $table->string('source_type', 32);
            $table->string('source_event_id', 128);
            $table->string('description', 16384);
            $table->string('catch_copy', 1024);
            $table->string('owner_id', 128);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->unique('url');
        });

        DB::statement("ALTER TABLE event MODIFY updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;");

        Schema::create('event_geolocation',
                       function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->unsignedInteger('region_code');
            $table->unsignedInteger('prefecture_code');
            $table->string('address', 128);
            $table->string('place', 128);
            $table->decimal('latitude', 7, 4)->nullable();
            $table->decimal('longitude', 7, 4)->nullable();
        });

        Schema::create('event_capacity',
                       function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->unsignedInteger('capacity_limit');
            $table->unsignedInteger('accepted');
            $table->unsignedInteger('waiting');
        });

        Schema::create('event_rating',
                       function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->unsignedInteger('hatena_bookmark_count');
            $table->unsignedInteger('twitter_count');
            $table->unsignedInteger('facebook_count');
            $table->unsignedInteger('google_plus_count');
            $table->unsignedInteger('pocket_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_rating');
        Schema::drop('event_capacity');
        Schema::drop('event_geolocation');
        Schema::drop('event');
    }

}
