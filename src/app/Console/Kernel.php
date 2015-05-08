<?php namespace App\Console;

use App\Console\Commands\EventCrawler\AtndCrawlerCommand;
use App\Console\Commands\EventCrawler\ConnpassCrawlerCommand;
use App\Console\Commands\EventCrawler\QueueCrawlerCommand;
use App\Console\Commands\SocialCrawler\SocialCrawlerCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		QueueCrawlerCommand::class,
		AtndCrawlerCommand::class,
		ConnpassCrawlerCommand::class,
		SocialCrawlerCommand::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
            //
	}

}
