<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Timesheet;

class TimesheetSeeder extends Seeder
{
    public function run()
    {
        Timesheet::create([
            'task_name' => 'Database Optimization',
            'date' => '2024-03-01',
            'hours' => 5,
            'user_id' => 1,
            'project_id' => 1,
        ]);

        Timesheet::factory(20)->create(); // Generate 20 random timesheets
    }
}
