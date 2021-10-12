<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'name' => 'Washington Awala',
            'email' => 'washingtonawala32@gmail.com',
            'email_verified_at' => Carbon::now(),
            'phone_number' => '+2547917472452',
            'password' => Hash::make('Awala@2021'),
        ]);
    }
}
