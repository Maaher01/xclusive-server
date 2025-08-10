<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

class DeleteOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete logs older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::table('logs')->where('created_at', '<', now()->subDays(30))->delete();
        })->daily();
    }
}
