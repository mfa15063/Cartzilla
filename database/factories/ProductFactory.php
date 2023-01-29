<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

                'category_id' => 1,
                'brand_id' => 1,
                'name' => $this->faker->name,
                'slug' => $this->faker->slug,
                'standard' => $this->faker->numberBetween(1000 , 50000),
                'description' => $this->faker->text,
                'product_image' => "product-1642858986100.png",
        ];
    }
}
