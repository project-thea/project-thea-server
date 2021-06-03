<?php

namespace Tests\Feature;

use App\Disease;
use App\Subject;
use App\Test;
use App\User;

use Tests\TestCase;

class CheckupTest extends TestCase
{
    /**
     * A feature test to store a newly created checkup test in storage.
     *
     * @return void
     */
    public function testCheckupCreatedSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Disease::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'James',
            'middle_name' => 'Joshua',
            'last_name' => 'Jakuma',
            'email' => 'james@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-09-11',
            'phone' => '0789567345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Test::factory()->create([
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16'
        ]);

        $testData = [
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16',
        ];

        $this->json('POST', 'api/tests', $testData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'disease_id',
                    'subject_id',
                    'test_date',
                    'status',
                    'status_update_date',
                    'created_at',
                    'updated_at',
                ],
                'message'
            ]);
    }

    /**
     * A feature test to display a listing of the checkup test.
     *
     * @return void
     */
    public function testCheckupListedSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Disease::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'James',
            'middle_name' => 'Joshua',
            'last_name' => 'Jakuma',
            'email' => 'james@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-09-11',
            'phone' => '0789567345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Disease::factory()->create([
            'name' => 'EBOLA',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'Joseph',
            'middle_name' => 'Janan',
            'last_name' => 'Hobbs',
            'email' => 'hobbs@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-07-13',
            'phone' => '0772667345',
            'next_of_kin' => 'Esther Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Disease::factory()->create([
            'name' => 'YELLOW FEVER',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'Sheilla',
            'middle_name' => 'Becky',
            'last_name' => 'Mukisa',
            'email' => 'sheny@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '1995-05-11',
            'phone' => '0783467345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0758765745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        Test::factory()->create([
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16'
        ]);

        Test::factory()->create([
            'disease_id' => 2,
            'subject_id' => 2,
            'test_date' => '2020-07-18',
            'status' => 'negative',
            'status_update_date' => '2020-07-23'
        ]);

        Test::factory()->create([
            'disease_id' => 3,
            'subject_id' => 3,
            'test_date' => '2021-03-18',
            'status' => 'unknown',
            'status_update_date' => '2021-03-24'
        ]);

        $this->json('GET', 'api/tests', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    [
                        'id',
                        'disease_id',
                        'subject_id',
                        'test_date',
                        'status',
                        'status_update_date',
                        'created_with',
                        'updated_with',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                        'first_name',
                        'last_name',
                        'name'
                    ],

                    [
                        'id',
                        'disease_id',
                        'subject_id',
                        'test_date',
                        'status',
                        'status_update_date',
                        'created_with',
                        'updated_with',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                        'first_name',
                        'last_name',
                        'name'
                    ],

                    [
                        'id',
                        'disease_id',
                        'subject_id',
                        'test_date',
                        'status',
                        'status_update_date',
                        'created_with',
                        'updated_with',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at',
                        'first_name',
                        'last_name',
                        'name'
                    ]
                ],
                'message'
            ]);
    }

    /**
     * A feature test to display the specific checkup test.
     *
     * @return void
     */
    public function testShowCheckupSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Disease::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'James',
            'middle_name' => 'Joshua',
            'last_name' => 'Jakuma',
            'email' => 'james@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-09-11',
            'phone' => '0789567345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        $test = Test::factory()->create([
            'id' => 1,
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16',
            'created_with' => 'user',
            'updated_with' => 'app',
        ]);

        $this->json('GET', 'api/tests/' . $test->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'disease_id',
                    'subject_id',
                    'test_date',
                    'status',
                    'status_update_date',
                    'created_with',
                    'updated_with',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at'
                ],
                'message'
            ]);
    }

    /**
     * A feature test to update the specific test in storage.
     *
     * @return void
     */
    public function testCheckupUpdatedSuccessfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Disease::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'James',
            'middle_name' => 'Joshua',
            'last_name' => 'Jakuma',
            'email' => 'james@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-09-11',
            'phone' => '0789567345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        $test = Test::factory()->create([
            'id' => 1,
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16',
            'created_with' => 'user',
            'updated_with' => 'app',
        ]);

        $payload = [
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16',
            'created_with' => 'user',
            'updated_with' => 'app',
        ];

        $this->json('PATCH', 'api/tests/' . $test->id, $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'disease_id',
                    'subject_id',
                    'test_date',
                    'status',
                    'status_update_date',
                    'created_with',
                    'updated_with',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
                'message'
            ]);
    }

    /**
     * A feature test to remove the specific test from storage.
     *
     * @return void
     */
    public function testDeleteCheckup()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        Disease::factory()->create([
            'name' => 'COVID',
            'description' => 'A deadly disease that people will develop moderate illness',
        ]);

        Subject::factory()->create([
            'first_name' => 'James',
            'middle_name' => 'Joshua',
            'last_name' => 'Jakuma',
            'email' => 'james@gmail.com',
            'nationality' => 'ugandan',
            'date_of_birth' => '2004-09-11',
            'phone' => '0789567345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0757595745',
            'unique_id' => 'qw3y674hyr543',
            'id_number' => 'CM914152316P',
            'id_type' => 'National ID',
        ]);

        $test = Test::factory()->create([
            'disease_id' => 1,
            'subject_id' => 1,
            'test_date' => '2020-08-12',
            'status' => 'positive',
            'status_update_date' => '2020-08-16',
            'created_with' => 'user',
            'updated_with' => 'app',
        ]);

        $this->json('DELETE', 'api/tests/' . $test->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }
}
