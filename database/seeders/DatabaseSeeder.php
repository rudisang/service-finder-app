<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Eloquent\Factories\Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();


        \App\Models\Role::factory()
        ->count(3)
        ->state(new Sequence(
            ['role' => 'Personal'],
            ['role' => 'Service Provider'],
            ['role' => 'Admin'],
        ))
        ->create();
    }
}
