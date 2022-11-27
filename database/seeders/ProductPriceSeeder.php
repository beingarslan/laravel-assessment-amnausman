<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $products = Product::all();
        $users = User::isClient()->get();

        $prices = [];

        foreach ($products as $product) {
            $prices[] = [
                'user_id' => $users->random()->id,
                'product_id' => $product->id,
                'price' => $faker->randomFloat(2, 1, 1000),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ProductPrice::insert($prices);
    }
}
