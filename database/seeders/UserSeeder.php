<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'Mamoona ',
                'email' => 'mamoonashuja2512@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make("password"),
                'is_admin' => 1,

            ]

        ]);
    }
}
