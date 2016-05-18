<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = [];

        foreach (range(1, 5) as $index) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => "{$faker->streetName} {$faker->postcode} {$faker->city}",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ];
        }

        DB::table('users')->insert($users);
    }
}
