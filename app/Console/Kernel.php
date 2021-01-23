<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// |   添加定时任务，在 linux的网站根目录下执行：
// |   crontab -e
// |   * * * * * php artisan schedule:run  > /dev/null 2>&1
// |   *：1-分钟(0 - 59)，2-小时(0 - 23)，3-一个月中的第几天(1 - 31)，4-月份(1 - 12) ，5-星期中星期几(0 - 7)(星期天 为0)
// +----------------------------------------------------------------------
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\TestTask::class //引入命令类
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('b5net:test')->everyMinute();//执行命令


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
