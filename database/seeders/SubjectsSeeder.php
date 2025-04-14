<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['name' => 'Mathematics'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Biology'],
            ['name' => 'English'],
            ['name' => 'History'],
            ['name' => 'Geography'],
            ['name' => 'French'],
            ['name' => 'Computer Science'],
            ['name' => 'Physical Education'],
        ]);
    }
}
