<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      User::factory(20)->create();
      Product::factory(500)->create();
      Offer::factory(500)->create();
        $this->call([
            StatesSeeder::class,
            CategoriesSeeder::class,
            CitiesTableSeeder::class,
            BrandSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            ProductSeeder::class,

        ]);
    }
}
