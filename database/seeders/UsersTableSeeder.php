<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'someone@gmail.com',
                'password' => Hash::make('pa12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],

            [
                'first_name' => 'Durant',
                'last_name' => 'James',
                'email' => 'durant@gmail.com',
                'password' => Hash::make('du12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'admin'
            ],

            [
                'first_name' => 'Jacob',
                'last_name' => 'Koko',
                'email' => 'koko@gmail.com',
                'password' => Hash::make('ko12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ], 

            [
                'first_name' => 'Arnold',
                'last_name' => 'Kunihira',
                'email' => 'arnold@gmail.com',
                'password' => Hash::make('ar12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'admin'
            ],
        ]);
    }
}
