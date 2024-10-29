<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Category::create([
                'name' => $name = $faker->word,
                'slug' => Str::slug($name),
                'category_image' => $faker->imageUrl(640, 480, 'categories', true, 'faker'),
                'description' => $faker->sentence,
                'status' => $faker->boolean,
                'popular' => $faker->boolean,
                'meta_title' => $faker->sentence(3),
                'meta_description' => $faker->sentence(6),
                'meta_keywords' => implode(',', $faker->words(5))
            ]);
        }
    }
}
