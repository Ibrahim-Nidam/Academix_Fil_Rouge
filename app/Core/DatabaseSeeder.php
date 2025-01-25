<?php
/*
 * Copyright © 2024 Ibrahim Nidam
 * All rights reserved.
 * Unauthorized use of this file, via any medium, is strictly prohibited.
 */

namespace Core;

use Faker\Factory;

class DatabaseSeeder extends Model
{
    private $faker;

    public function __construct() {
        parent::__construct();
        $this->faker = Factory::create();
    }

    public function run(){

    }
}