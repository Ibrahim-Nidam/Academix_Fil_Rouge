<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classrooms')->insert([
            ['name' => 'Class 1A'],
            ['name' => 'Class 1B'],
            ['name' => 'Class 2A'],
            ['name' => 'Class 2B'],
            ['name' => 'Class 3A'],
            ['name' => 'Class 3B'],
            ['name' => 'Class 4A'],
            ['name' => 'Class 4B'],
            ['name' => 'Class 5A'],
            ['name' => 'Class 5B'],
        ]);
    }
}
