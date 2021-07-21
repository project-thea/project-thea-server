<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    public const USER_ID = 1;
    public const USER_TITLE = 'User';

    public const ADMIN_ID = 2;
    public const ADMIN_TITLE = 'Admin';

    public const LAB_TECHNICIAN_ID = 3;
    public const LAB_TECHNICIAN_TITLE = 'Lab-Technician';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => self::USER_ID,
                'name' => self::USER_TITLE,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => self::ADMIN_ID,
                'name' => self::ADMIN_TITLE,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => self::LAB_TECHNICIAN_ID,
                'name' => self::LAB_TECHNICIAN_TITLE,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        Role::insert($roles);
    }
}
