<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timesheets = [];

        for ($i = 1; $i <= 10; $i++) {
            $timesheets[] = [
                'project_id'  => 'PRJ' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'staff_id'     => rand(1, 5),
                'entry_date'   => Carbon::now()->subDays(rand(0, 30))->format('Y-m-d'),
                'hours_spent'  => rand(1, 8) + (rand(0, 1) ? 0.5 : 0),
                'notes'        => 'test explanation' . Str::random(20),
                'status'      => (rand(0, 1) ? 'active' : 'inactive'),
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('timesheets')->insert($timesheets);
    }
}
