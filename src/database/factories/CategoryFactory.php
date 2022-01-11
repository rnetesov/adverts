<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->sentence(random_int(2, 3));
        return [
            'name' => $name,
            'slug' => \Str::slug($name)
        ];
    }
}
