<?php namespace App\Console;

use App\Console\Commands\EventCrawler\AtndCrawlerCommand;
use App\Console\Commands\EventCrawler\ConnpassCrawlerCommand;
use App\Console\Commands\EventCrawler\DoorkeeperCrawlerCommand;
use App\Console\Commands\EventCrawler\PartakeCrawlerCommand;
use App\Console\Commands\EventCrawler\QueueCrawlerCommand;
use App\Console\Commands\EventCrawler\ZusaarCrawlerCommand;
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
		DoorkeeperCrawlerCommand::class,
		ZusaarCrawlerCommand::class,
		PartakeCrawlerCommand::class,
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
