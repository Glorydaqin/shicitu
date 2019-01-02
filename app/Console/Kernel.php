<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\App;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        Commands\downImg::class,
        Commands\downImgQcloud::class,
        Commands\downFile::class,
//        Commands\getTV::class,


        //source
        Source\bt::class,
        Source\onlineWatch::class,
        Source\syncPerson::class,

        //ES
        ES\sync::class,
        ES\create::class,

        Commands\Script::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('down:file')->daily()->runInBackground()->withoutOverlapping();
//        $schedule->command('down:imgQcloud')->everyTenMinutes()->runInBackground()->withoutOverlapping();
        $schedule->command('down:img')->everyTenMinutes()->runInBackground()->withoutOverlapping();
        $schedule->command('get:movie')->daily()->runInBackground()->withoutOverlapping();

        //相关资源
        $schedule->command('source:bt')->daily()->runInBackground()->withoutOverlapping();
        $schedule->command('source:onlineWatch')->daily()->runInBackground()->withoutOverlapping();
        $schedule->command('source:syncPerson')->daily()->runInBackground()->withoutOverlapping();

        //es
        $schedule->command('es:sync')->hourly()->runInBackground()->withoutOverlapping();

        $schedule->command('command:script')->cron("10 10 * * *")->runInBackground()->withoutOverlapping();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
