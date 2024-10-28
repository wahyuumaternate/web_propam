<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanUpActivityLog extends Command
{
    protected $signature = 'activitylog:cleanup';
    protected $description = 'Clean up Activity Log table by deleting entries older than one year';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // tahun
        $oneYearAgo = Carbon::now()->subYear();
        ActivityLog::where('created_at', '<', $oneYearAgo)->delete();

        // menit
        // $oneMinuteAgo = Carbon::now()->subMinute();
        // ActivityLog::where('created_at', '<', $oneMinuteAgo)->delete();

        $this->info('Old activity log entries have been cleaned up.');
    }
}
