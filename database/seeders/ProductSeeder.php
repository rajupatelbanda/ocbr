<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'cate_id' => $faker->numberBetween(1,10), // Assuming you have categories with IDs from 1 to 10
                'product_name' => $faker->word . ' ' . $faker->word,
                'small_description' => $faker->sentence,
                'description' => $faker->paragraph,
                'original_price' => $faker->randomFloat(2, 10, 100), // Random price between 10 and 100
                'selling_price' => $faker->randomFloat(2, 5, 90), // Random price between 5 and 90
                'image' => $faker->imageUrl(640, 480, 'product', true), // Generates a random image URL
                'qty' => $faker->numberBetween(1, 100), // Random quantity between 1 and 100
                'tax' => $faker->randomFloat(2, 0, 10), // Random tax value
                'status' => $faker->boolean, // Random status (active/inactive)
                'trending' => $faker->boolean, // Random trending value
                'meta_title' => $faker->sentence,
                'meta_keywords' => implode(',', $faker->words(3)), // Random keywords
                'meta_description' => $faker->paragraph,
            ]);
        }
    }
}
