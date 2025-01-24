<?php

namespace Core;

use Faker\Factory;

class DatabaseSeeder extends Model
{
    private $faker;

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    public function run(){

    }
}