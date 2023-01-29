<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(1000 , 7000),
            'description' => $this->faker->paragraph,
            'offer_image' => "product-1642947094181.jpg",
            'product_id' => 1
        ];
    }
}
