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
            'facebook' => 'dennis.okanga.1',
            'twitter' => 'kanga700',
            'instagram' => 'okanga700',
            'linked_in' => 'dennis-okanga-378666203'
        ]);
    }
}
