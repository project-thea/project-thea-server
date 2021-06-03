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
                'middle_name' => 'Someone',
                'last_name' => 'Smith',
                'email' => 'someone@gmail.com',
                'password' => Hash::make('pa12345678'),
                'nationality' => 'Ugandan',
                'date_of_birth' => '1998-09-21',
                'user_mobile' => '0773784676',
                'next_of_kin' => 'Andrew Rugamba',
                'next_of_kin_mobile' => '0753578647',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Durant',
                'middle_name' => 'Atwine',
                'last_name' => 'James',
                'email' => 'durant@gmail.com',
                'password' => Hash::make('du12345678'),
                'nationality' => 'Ugandan',
                'date_of_birth' => '1994-07-15',
                'user_mobile' => '0772777567',
                'next_of_kin' => 'Noah Rukundo',
                'next_of_kin_mobile' => '0756658904',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Jacob',
                'middle_name' => 'Twine',
                'last_name' => 'Koko',
                'email' => 'koko@gmail.com',
                'password' => Hash::make('ko12345678'),
                'nationality' => 'Ugandan',
                'date_of_birth' => '1992-07-15',
                'user_mobile' => '0772777567',
                'next_of_kin' => 'Noah Rubondo',
                'next_of_kin_mobile' => '0756658904',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
