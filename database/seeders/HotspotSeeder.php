<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotspotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'latitude' => 0.31712705739729,
                'longitude' => 32.587137962393,
                'date_time' =>  '2023-03-02 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 1000,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => 'dbca4739-b3ee-4d40-8597-a1162b66efc5,5fe4ea7d-202c-4c71-b992-60888b5ad90d,773a7d27-a852-4980-9f84-d8257b9e54a7,24534f9c-c56f-4d83-a7cb-e816cfec312d,da8b36e4-a747-4dfb-9e96-cc9acadb4db0,c2bee5d1-5e25-4415-8527-27f51770fab5'
            ],
            [
                'latitude' => 0.62473798827854,
                'longitude' => 34.257128581545,
                'date_time' =>  '2023-03-03 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 34,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => 'b9e897ff-f8ec-4c12-b93f-3a9aab066640,933872fc-1160-4d4e-9751-17e14688f7aa,6dcbe30b-7898-4389-b622-cb57522a67bf,f9ff6266-e420-4cb1-b0de-87efd51803f1,d81fc731-6af5-4f5f-874f-462e553599d3,5b767345-f209-486d-adde-e0eb93dd48d4,a96896aa-40e6-4982-8785-a563e3b53793,6bc4bd2d-9916-4969-b31b-d3564defffc1,7a999f5f-b947-4e8e-9c29-f629415f1cf6,09a43c9b-9f5e-4bd7-acf2-4e3a3b232c9c,787b4753-79d1-43c8-a2fa-57613fbae984,5c1b51e4-88c9-4322-abc8-6a924f32829f,9cd1245a-edf6-44d5-a99d-fac30619d6ee,68ed385a-b824-40e2-92c5-87772332f657,5843398e-07ae-4ca4-9a7d-9a1c6b72306e,b58840a6-3b61-45ff-b932-690912f0819a,4ec011d8-31c9-492e-9566-1649b43f261c,33bc94ce-41d6-4523-8cbe-d034e51dea00,4c982759-0419-4515-bf92-15a7a6f0d987,7dad3c82-cded-482a-a475-e0a7cb7da700,47fe9302-bd0c-4d2b-a951-f2e1f04d34e8,b7f0acc4-c01d-4b21-9682-0c31fc56a559,9ce7d25e-ad9b-4a56-8dd7-b5f978e6b288,4776e1aa-2803-452c-a6c5-ad85c893aa49,d6de1715-d74a-44f4-968b-12af8996f402,193156c1-88c9-4b40-acf7-7a29d62437cf,de8aab05-bd50-4dae-9239-59742a25bd30,d6089822-d12a-4cf4-b736-367da9ed560d,63078411-e0d5-4ca6-9fb0-46d581357fe9,55c0cc3a-b064-42c0-9ff0-bfab01dd8e6e,b2d3e1d3-5070-479a-8a4a-836df47b845a,cc7aae47-1d46-4c67-addf-34e030ae45c5,6df30e4a-a7fa-4614-8b80-e58204a77541,fa0c9df8-5877-42f5-9b44-d00c0f75bc3e,0279d273-a1cd-4a5f-bab8-03b3c9cb0353,76f56ed0-9a17-4ecb-ac99-ee3035268f34,d08a2782-d4b7-4e19-945c-96b1d8bfa6bf,2fb73ae0-80ef-4852-a165-3518800de868,52c69dc9-5a86-4a23-a142-c420eae6d271,c0342378-16df-4034-a5ad-57fec354d81b'
            ],
            [
                'latitude' => 0.62812968699749,
                'longitude' => 34.259194885959,
                'date_time' =>  '2023-03-03 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 34,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => '69957ae4-4d53-4ecb-9090-83001de5e396,b9e897ff-f8ec-4c12-b93f-3a9aab066640,f9ff6266-e420-4cb1-b0de-87efd51803f1,933872fc-1160-4d4e-9751-17e14688f7aa,0279d273-a1cd-4a5f-bab8-03b3c9cb0353,68ed385a-b824-40e2-92c5-87772332f657,09a43c9b-9f5e-4bd7-acf2-4e3a3b232c9c,52c69dc9-5a86-4a23-a142-c420eae6d271,5c1b51e4-88c9-4322-abc8-6a924f32829f,5843398e-07ae-4ca4-9a7d-9a1c6b72306e,c0342378-16df-4034-a5ad-57fec354d81b'
            ],
            [
                'latitude' => 0.62507624120376,
                'longitude' => 34.239555205848,
                'date_time' =>  '2023-03-03 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 34,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => '933872fc-1160-4d4e-9751-17e14688f7aa,68ed385a-b824-40e2-92c5-87772332f657,a96896aa-40e6-4982-8785-a563e3b53793,5843398e-07ae-4ca4-9a7d-9a1c6b72306e,c0342378-16df-4034-a5ad-57fec354d81b'
            ],
            [
                'latitude' => 0.66070699262643,
                'longitude' => 34.173882455253,
                'date_time' =>  '2023-03-03 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 34,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => 'c2bee5d1-5e25-4415-8527-27f51770fab5,a945a5fe-14ba-4605-a9ea-9d8f02459855,f9ff6266-e420-4cb1-b0de-87efd51803f1,933872fc-1160-4d4e-9751-17e14688f7aa,9cd1245a-edf6-44d5-a99d-fac30619d6ee,c0342378-16df-4034-a5ad-57fec354d81b'
            ],
            [
                'latitude' => 0.298015078842,
                'longitude' => 32.532051284879,
                'date_time' =>  '2023-03-03 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 34,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => '51dde681-1ed1-4659-b4e4-ca3d361e664f,1652f729-fb7b-4850-821f-0b16d9aacbe2,84ce0318-95b5-4284-ad54-48c0816ed499,75ac8956-7324-48c6-a0eb-682e44ee9545,b56eb6da-1bf5-486c-946a-583297e4de0f,93d54bd3-ace3-4480-8929-f960d67d4434,64388b74-4efb-4674-bca1-065bc39ee9cd'
            ],
            [
                'latitude' => 0.6413689713001,
                'longitude' => 34.254726064026,
                'date_time' =>  '2023-03-02 00:00:00',  //\Carbon\Carbon::now()->fornat('Y-m-d H:i:s'),
                'strength' => 34,
                'priority' => 'low',
                'created_at' => null,
                'updated_at' => null,
                'drivers' => '80e9917f-febd-4010-8264-c8c16b6c6110,8fe632f2-e2c4-4819-a14e-8cae73b35b95,abcfff88-b6c7-40ea-ab9f-db39152763b7,b9e897ff-f8ec-4c12-b93f-3a9aab066640,933872fc-1160-4d4e-9751-17e14688f7aa,f9ff6266-e420-4cb1-b0de-87efd51803f1,711322e2-3199-49f5-a327-2383982c201f,d81fc731-6af5-4f5f-874f-462e553599d3'
            ],
          
        ];

        DB::table('hotspots')->insert($data);

    }
}
