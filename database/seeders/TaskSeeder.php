<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Sample data for tasks
        $tasks = [
            [
                'categorie_id' => 1, // Replace with actual category ID
                'statu_id' => 1, // Replace with actual status ID
                'title' => 'Task 1',
                'description' => 'Description for Task 1',
                'startDate' => Carbon::now(),
                'endDate' => Carbon::now()->addDays(5),
                'expectedEndDate' => Carbon::now()->addDays(5),
                
            ],
            [
                'categorie_id' => 2, // Replace with actual category ID
                'statu_id' => 2, // Replace with actual status ID
                'title' => 'Task 2',
                'description' => 'Description for Task 2',
                'startDate' => Carbon::now(),
                'endDate' => Carbon::now()->addDays(10),
                'expectedEndDate' => Carbon::now()->addDays(10),
                
            ],
            // Add more task entries here
        ];

        // Insert data into the 'tasks' table
        DB::table('tasks')->insert($tasks);
    }
}
