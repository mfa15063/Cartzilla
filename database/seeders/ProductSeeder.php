<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'brand_id' => 1,
                'name' => "Hp dw-1509",
                'slug' => "Hp-dw-1509",
                'standard' => 7000,
                'description' => "Best product",


            ],
            [
                'category_id' => 2,
                'brand_id' =>2,
                'name' => "Galaxy S20 5G",
                'slug' => "Galaxy-S20-5G",
                'standard' => 9000,
                'description' => "Best product",


            ],
            [
                'category_id' => 2,
                'brand_id' =>5,
                'name' => "Apple i phone 13 pro",
                'slug' => "Apple-i-hpne-13-pro",
                'standard' => 9500,
                'description' => "Best product",


            ],
            [
                'category_id' => 1,
                'brand_id' => 1,
                'name' => "Acer 95757",
                'slug' => "Acer-95757",
                'standard' => 7000,
                'description' => "Best product",


            ],
            [
                'category_id' => 2,
                'brand_id' =>2,
                'name' => "Galaxy S21 Plus",
                'slug' => "Galaxy-s21-plus",
                'standard' => 9900,
                'description' => "Best product",


            ],
            [
                'category_id' => 2,
                'brand_id' =>5,
                'name' => "Apple i phone 12",
                'slug' => "Apple-i-phone-12",
                'standard' => 10000,
                'description' => "Best product",


            ],

        ]);

    }
}
