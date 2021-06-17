<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectTracking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectTrackingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature test to store a newly created subject tracking test in storage.
     *
     * @return void
     */
    public function test_subject_tracking_created_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Subject::factory()->create([
            'name' => 'Gerald Begumisa',
            'email' => 'jose@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '1985-08-04',
            'phone' => '0789153745',
            'next_of_kin' => 'Dylan Mwebaze',
            'next_of_kin_phone' => '0757895745',
            'unique_id' => 'qw3y674fyr543',
            'id_number' => 'CM91415y616P',
            'id_type' => 'National ID',
        ]);

        SubjectTracking::factory()->create([
            'subject_id' => 1,
            'latitude' => '2.536988',
            'longitude' => '33.603586',
            'unique_id' => '7e57d004-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 15:36:32',
            'created_by' => 2,
            'updated_by' => 1,
        ]);

        $trackingData = [
            'subject_id' => 1,
            'latitude' => '2.536988',
            'longitude' => '33.603586',
            'unique_id' => '7e57d004-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 15:36:32',
            'created_by' => 2,
            'updated_by' => 1,
        ];

        $this->json('POST', 'api/tracking/subject', $trackingData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'subject_id',
                    'latitude',
                    'longitude',
                    'unique_id',
                    'date_time',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
                'message'
            ]);
    }

    /**
     * A feature test to display a listing of the subject tracking.
     *
     * @return void
     */
    public function test_subject_tracking_listed_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Subject::factory()->create([
            'name' => 'Gerald Begumisa',
            'email' => 'jose@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '1985-08-04',
            'phone' => '0789153745',
            'next_of_kin' => 'Dylan Mwebaze',
            'next_of_kin_phone' => '0757895745',
            'unique_id' => 'qw3y674fyr543',
            'id_number' => 'CM91415y616P',
            'id_type' => 'National ID',
        ]);

        SubjectTracking::factory()->create([
            'subject_id' => 1,
            'latitude' => '2.536988',
            'longitude' => '33.603586',
            'unique_id' => '7e57df34-2b97-0e7a-D45f',
            'date_time' => '2020-09-01 15:41:32'
        ]);

        Subject::factory()->create([
            'name' => 'Jeff Bwete',
            'email' => 'bwete@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '1989-08-04',
            'phone' => '0789136745',
            'next_of_kin' => 'Dylan Kangaroo',
            'next_of_kin_phone' => '0757185745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM91412b616P',
            'id_type' => 'National ID',
        ]);

        SubjectTracking::factory()->create([
            'subject_id' => 2,
            'latitude' => '2.168988',
            'longitude' => '31.678486',
            'unique_id' => '7e57d004-2h97-0e7a-D45f',
            'date_time' => '2020-09-01 15:42:28'
        ]);

        Subject::factory()->create([
            'name' => 'Raymond Musoke',
            'email' => 'musoke@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '1986-03-23',
            'phone' => '0772913787',
            'next_of_kin' => 'Andrew Kalyejera',
            'next_of_kin_phone' => '0757189945',
            'unique_id' => 'qm3z674hyr543',
            'id_number' => 'CM91f312b616P',
            'id_type' => 'National ID',
        ]);

        SubjectTracking::factory()->create([
            'subject_id' => 3,
            'latitude' => '2.539688',
            'longitude' => '33.686586',
            'unique_id' => '7e57d234-2b97-0d7a-D45f',
            'date_time' => '2020-09-01 15:44:04'
        ]);

        $this->json('GET', 'api/tracking/subject', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    [
                        'subject_id',
                        'latitude',
                        'longitude',
                        'unique_id',
                        'date_time',
                    ],

                    [
                        'subject_id',
                        'latitude',
                        'longitude',
                        'unique_id',
                        'date_time',
                    ],

                    [
                        'subject_id',
                        'latitude',
                        'longitude',
                        'unique_id',
                        'date_time',
                    ],
                ],
                'message'
            ]);
    }
}
