<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting attendance fetch...');
        $this->fetchAttendance(); // This comes from your ZktecoFetchTrait
        $this->info('Attendance fetch completed!');
    }
}
