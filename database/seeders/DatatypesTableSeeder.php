<?php

namespace Database\Seeders;

use App\Models\DataType;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatatypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataTypes = [
            [
                'id' => 1,
                'name' => 'date',
                'attributes' => '{
                    "format": ["d-m-y", "y-m-d", "d/m/y", "y/m/d"],
                    "required": ["true", "false"],
                    "appearance": ["calendar", "text"],
                    "default": "2021-08-25"
                }',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 2,
                'name' => 'time',
                'attributes' => '{
                    "format": ["12hrs", "24hrs"],
                    "required": ["true", "false"],
                    "default": "14:46:51"
                }',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 3,
                'name' => 'datetime',
                'attributes' => '{
                    "format": ["12hrs", "24hrs"],
                    "required": ["true", "false"],
                    "default": "2021-08-25 14:54:21",
                    "timezone": "Kampala",
                    "appearance": ["calendar", "text"]
                }',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 4,
                'name' => 'checkbox',
                'attributes' => '{
                    "required": ["true", "false"],
                    "options": []
                }',
                'created_by' => '1',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 5,
                'name' => 'radio button',
                'attributes' => '{
                    "required": ["true", "false"],
                    "options": []
                }',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id' => 6,
                'name' => 'text',
                'attributes' => '{
                    "format": ["textfield", "textarea"],
                    "required": ["true", "false"],
                    "appearance": ["singleline","multiline"]
                }',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DataType::insert($dataTypes);
    }
}
