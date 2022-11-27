<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $products = [];

        for ($i = 0; $i < 100; $i++) {
            $products[] = [
                'title' => $faker->text(50),
                'description' => $faker->text,
                'price' => $faker->randomFloat(2, 1, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Product::insert($products);
    }
}
