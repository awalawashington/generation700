<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_media')->insert([
            'name' => 'Facebook',
            'icon' => 'bi bi-facebook',
            'link' => 'https://www.facebook.com/awalatechincorporation'
        ]);

        DB::table('social_media')->insert([
            'name' => 'Twitter',
            'icon' => 'bi bi-twitter',
            'link' => 'https://twitter.com/AwalaTech'
        ]);
    }
}
