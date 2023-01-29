<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            'name' => 'required|unique:offers|min:2|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|min:6',
            'offer_image' => 'required|image',
            'product_id' => 'required'
        ];
    }
}
