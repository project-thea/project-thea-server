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

            [
                'first_name' => 'Chris',
                'last_name' => 'Balya',
                'email' => 'balya@gmail.com',
                'password' => Hash::make('ba12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],

            [
                'first_name' => 'Joselyn',
                'last_name' => 'Mudra',
                'email' => 'mudra@gmail.com',
                'password' => Hash::make('mu12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],

            [
                'first_name' => 'Doreen',
                'last_name' => 'Muhangi',
                'email' => 'dora@gmail.com',
                'password' => Hash::make('do12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'admin'
            ],

            [
                'first_name' => 'Edwin',
                'last_name' => 'Kiconco',
                'email' => 'edy@gmail.com',
                'password' => Hash::make('ed12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],

            [
                'first_name' => 'Oscar',
                'last_name' => 'Musoke',
                'email' => 'oscar@gmail.com',
                'password' => Hash::make('os12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],

            [
                'first_name' => 'Joel',
                'last_name' => 'Tibuhabz',
                'email' => 'tibz@gmail.com',
                'password' => Hash::make('tz12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],

            [
                'first_name' => 'Maxima',
                'last_name' => 'Nsime',
                'email' => 'max@gmail.com',
                'password' => Hash::make('max12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role' => 'user'
            ],
        ]);
    }
}
