<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MigrationToAllDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BasicSetup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all migrations and seeders to all databases';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Dropping all tables in the current database...');
        $tables = DB::select('SHOW TABLES');

        // print_r($tables);
        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            DB::statement('DROP TABLE ' . $tableName);
        }
        $this->info('All tables dropped successfully!');

        $this->info('Checking if migrations are needed...');
        $this->info('Running migrations...');
        Artisan::call('migrate');
        $this->info(Artisan::output());
        $this->info('Migrations completed!');
        $this->info('Checking if seeders are needed...');
        $this->info('Running seeders...');
        $seeders = [
            'DatabaseSeeder'
        ];

        foreach ($seeders as $seeder) {
            Artisan::call('db:seed', [
            '--class' => $seeder,
            ]);
            $this->info(Artisan::output());
        }
        $this->info('Seeders completed!');
        $this->info('Migrations and seeders executed successfully!');
        $this->info('All databases are now up to date.');
        return 0;
    }

    
}
