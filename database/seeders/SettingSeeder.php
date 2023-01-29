<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'setting_key' => 'address',
                'setting_name' => 'address',
                'setting_value' => 'Ghauri Town, Phase 5B, Islamabad',
                'is_readonly' => '0',

            ],
            [
                'setting_key' => 'privacy_policy',
                'setting_name' => 'privacy_policy',
                'setting_value' => 'Policy',
                'is_readonly' => '0',

            ],
            
            [
                'setting_key' => 'terms_and_condition',
                'setting_name' => 'terms_and_condition',
                'setting_value' => 'Terms',
                'is_readonly' => '0',

            ],
            [
                'setting_key' => 'phone_number',
                'setting_name' => 'Phone Number',
                'setting_value' => ' +92 3215448926',
                'is_readonly' => '0',
            ],
            [
                'setting_key' => 'mobile_number',
                'setting_name' => 'Mobile Number',
                'setting_value' => '+92 3035448926',
                'is_readonly' => '0',
            ],


            [
                'setting_key' => 'twitter_account',
                'setting_name' => 'Twitter Account',
                'setting_value' => 'www.twitter.com/luqman6666',
                'is_readonly' => '0',
            ],

            [
                'setting_key' => 'facebook_account',
                'setting_name' => 'Facebook Account',
                'setting_value' => 'www.facebook.com/',
                'is_readonly' => '0',
            ],
            [
                'setting_key' => 'instagram_account',
                'setting_name' => 'Instagram account',
                'setting_value' => 'https://www.instagram.com/',
                'is_readonly' => '0',
            ],
            [
                'setting_key' => 'email_address',
                'setting_name' => 'Email Address',
                'setting_value' => 'luqman@luqmansoftwares.com',
                'is_readonly' => '0',
            ],

        ]);
    }

}
