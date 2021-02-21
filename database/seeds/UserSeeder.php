<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {
            App\User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => '$2y$10$aqZedF.e9UFXRsNm7LnJIeJyAHWh/6sUxNZjewFJwFpPmgG7sW/mu'
            ]);
        }
    }
}
