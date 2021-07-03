<?php

namespace Tests\Feature;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    use RefreshDatabase;
	
    public function setUp(): void
    {
        parent::setUp();
	    
		$this->user = User::factory()->create();
        $this->actingAs($this->user);
	}

    /**
     * Test if subjects can be listed
     *
     * @return void
     */
    public function test_can_list_subjects()
    {
        Subject::factory()->create([
            'first_name' => 'Sheilla',
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

        $this->json('GET', 'api/subjects', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    [
                        'first_name',
                        'last_name',
                        'email',
						'nationality',
						'date_of_birth',
						'phone',
						'next_of_kin',
						'next_of_kin_phone',
                        'unique_id',
						'id_number',
						'id_type'
                    ]
                ],
                'message'
            ]);
			
    }

    /**
     * Test that a user can view subject details
     *
     * @return void
     */
    public function test_can_view_subject_details()
    {
        $subject = Subject::factory()->create([
            'first_name' => 'Sheilla',
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
			
        $this->json('GET', 'api/subjects/' . $subject->id, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                        'first_name',
                        'last_name',
                        'email',
						'nationality',
						'date_of_birth',
						'phone',
						'next_of_kin',
						'next_of_kin_phone',
                        'unique_id',
						'id_number',
						'id_type'
				],
                'message'
            ]);
    }

    /**
     * Test that a user can delete a subject
     *
     * @return void
     */
    public function test_can_delete_subject()
    {
        $subject = Subject::factory()->create([
            'first_name' => 'Sheilla',
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
		
		$resp = $this->json('DELETE', 'api/subjects/' . $subject->id, ['Accept' => 'application/json'])
			->assertStatus(204);
    }


    /**
     * Test that a user can delete a subject
     *
     * @return void
     */
    public function test_can_update_subject_info()
    {
		$subject_data = [
            'first_name' => 'Sheilla',
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
        ];
		
        $subject = Subject::factory()->create($subject_data);
		
		$new_data['first_name'] = 'NewSheila';
		
		$new_subject_data = [
            'first_name' => 'NewSheila',
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
        ];
		
		$this->json('PUT', 'api/subjects/' . $subject->id, $new_data, ['Accept' => 'application/json'])
			->assertStatus(200)
            ->assertJson([
				'status' => 'success',
				'data' => $new_subject_data,
				'message' => 'Subject updated successfully'
			]);
			

 
    }
}
