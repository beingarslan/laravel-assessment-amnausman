<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $users[] = [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234567890'),
            'is_admin' => true,
        ];

        for ($i = 0; $i < 100; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('1234567890'),
                'is_admin' => rand(0, 1),
            ];
        }

        User::insert($users);
    }
}
