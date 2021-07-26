<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusesTableSeeder extends Seeder
{
    public const NEGATIVE_ID = 1;
    public const STATUS_NEGATIVE = 'Negative';

    public const POSITIVE_ID = 2;
    public const STATUS_POSITIVE = 'Positive';

    public const UNKNOWN_ID = 3;
    public const STATUS_UNKNOWN = 'Unknown';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => self::NEGATIVE_ID,
                'title' => self::STATUS_NEGATIVE,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => self::POSITIVE_ID,
                'title' => self::STATUS_POSITIVE,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => self::UNKNOWN_ID,
                'title' => self::STATUS_UNKNOWN,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Status::insert($statuses);
    }
}
