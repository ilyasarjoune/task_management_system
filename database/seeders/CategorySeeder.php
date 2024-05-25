<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate the table to start fresh
        DB::table('categories')->truncate();

        // Sample data for categories
        $categories = [
            ['name' => 'Category 1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 4', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 5', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 6', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 7', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 8', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 9', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Category 10', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert data into the 'categories' table
        DB::table('categories')->insert($categories);

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}