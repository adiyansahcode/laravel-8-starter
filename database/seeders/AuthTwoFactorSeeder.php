<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthTwoFactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php faker
        $faker = \Faker\Factory::create();

        // truncate db
        DB::table('auth_two_factor')->truncate();

        // Create user manual with DB Facades
        DB::table('auth_two_factor')->insert([
            [
                'uuid' => $faker->uuid,
                'name' => 'email',
            ],
        ]);
    }
}
