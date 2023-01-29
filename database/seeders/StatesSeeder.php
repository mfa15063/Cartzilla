<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            [  'name' => 'Eastern Cape',

            ],
            [
                'name' => 'Free State',

            ],
            [
                'name' => 'Gauteng',

            ],
            [
                'name' => 'KwaZulu-Natal',

            ],
            [
                'name' => 'Limpopo',

            ],
            [
                'name' => 'Mpumalanga',

            ],
            [
                'name' => 'Northern Cape',

            ],
            [
                'name' => 'North West',

            ],
            [
                'name' => 'western  Cape',

            ],

        ]);
    }
}
