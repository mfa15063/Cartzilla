<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => 'East London',
                'state_id' => 1,

            ],
            [
                'name' => 'Adelaide',
                'state_id' => 1,
            ],
            [
                'name' => 'Bloemfontein',
                'state_id' => 2,

            ],
            [
                'name' => 'Villiers',
                'state_id' => 2,
            ],

            [
                'name' => 'Kimberley',
                'state_id' => 7,

            ],
            [
                'name' => 'Cape Town',
                'state_id' => 9,

            ],
            [
                'name' => 'Fish Hoek',
                'state_id' => 9,

            ],
            [
                'name' => 'Atlantis',
                'state_id' => 9,

            ],

        ]);
    }
}
