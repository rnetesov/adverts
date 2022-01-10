<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    protected $model = Region::class;

    public function definition(): array
    {
        $name = $this->faker->city;
        $slug = \Str::slug($name);

        return [
            'parent_id' => null,
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
