<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory(5)->create()->each(function (Category $category) {
            $category->children()->saveMany(Category::factory(random_int(1, 3))->create()->each(function (Category $category) {
                $category->children()->saveMany(Category::factory(random_int(1, 3))->create());
            }));
        });
    }
}
