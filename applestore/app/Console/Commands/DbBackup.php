<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database Backup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = 'backup_'.strtotime(now()).'.sql';
        $command = '/Applications/MAMP/Library/bin/mysqldump --user='.env('DB_USERNAME').' -proot applestore > '.storage_path().'/app/backup/'.$filename;
        exec($command);
    }
}
