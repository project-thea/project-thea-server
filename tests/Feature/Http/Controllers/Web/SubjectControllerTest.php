<?php

namespace Tests\Feature\HTTP\Controllers\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\Subject;
use Inertia\Testing\Assert;

class SubjectControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_a_subjects_index_page_is_rendered()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/subjects')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Subjects/Index')
                    ->has('subjects')
                    ->has('trashedSubjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });
    }

    public function test_a_subject_name_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $this->actingAs($user);

        $subjectData = [
            'first_name' => '',
            'last_name' => '',
            'email' => 'cobs@gmail.com',
            'nationality' => 'Ugandan',
            'date_of_birth' => '1985-07-16',
            'phone' => '0783456812',
            'next_of_kin' => 'Jrue Holiday',
            'next_of_kin_phone' => '0779673752',
            'id_number' => 'CF5G67E54F24',
            'id_type' => 'National ID',
        ];

        $response = $this->post('/subjects', $subjectData);

        $response->assertSessionHasErrors('first_name');
        $response->assertSessionHasErrors('last_name');
    }

    public function test_a_subject_next_of_kin_details_are_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $this->actingAs($user);

        $subjectData = [
            'first_name' => 'Hansen',
            'last_name' => 'Jacobs',
            'email' => 'cobs@gmail.com',
            'nationality' => 'Ugandan',
            'date_of_birth' => '1985-07-16',
            'phone' => '0783456812',
            'next_of_kin' => '',
            'next_of_kin_phone' => '',
            'id_number' => 'CF5G67E54F24',
            'id_type' => 'National ID',
        ];

        $response = $this->post('/subjects', $subjectData);

        $response->assertSessionHasErrors('next_of_kin');
        $response->assertSessionHasErrors('next_of_kin_phone');
    }

    public function test_a_subject_id_details_are_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $this->actingAs($user);

        $subjectData = [
            'first_name' => 'Hansen',
            'last_name' => 'Jacobs',
            'email' => 'cobs@gmail.com',
            'nationality' => 'Ugandan',
            'date_of_birth' => '1985-07-16',
            'phone' => '0783456812',
            'next_of_kin' => 'Jrue Holiday',
            'next_of_kin_phone' => '0779673752',
            'id_number' => '',
            'id_type' => '',
        ];

        $response = $this->post('/subjects', $subjectData);

        $response->assertSessionHasErrors('id_number');
        $response->assertSessionHasErrors('id_type');
    }

    public function test_a_subject_other_details_are_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $this->actingAs($user);

        $subjectData = [
            'first_name' => 'Hansen',
            'last_name' => 'Jacobs',
            'email' => '',
            'nationality' => '',
            'date_of_birth' => '',
            'phone' => '',
            'next_of_kin' => 'Jrue Holiday',
            'next_of_kin_phone' => '0779673752',
            'id_number' => 'CF5G67E54F24',
            'id_type' => 'National ID',
        ];

        $response = $this->post('/subjects', $subjectData);

        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('nationality');
        $response->assertSessionHasErrors('date_of_birth');
        $response->assertSessionHasErrors('phone');
    }



    public function test_a_subject_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $expected = [
            'first_name' => 'Andrew',
            'last_name' => 'Mugisha',
            'email' => 'andrew@gmail.com',
            'nationality' => 'Ugandan',
            'date_of_birth' => '1995-05-11',
            'phone' => '0783467345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0758765745',
            'unique_id' => 'qw3y-674h-yr54-56tf',
            'id_number' => 'CM9141523161023K',
            'id_type' => 'National ID'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/subjects', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Subjects/Index')
                    ->has('subjects')
                    ->has('trashedSubjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $subject = Subject::where('email', $expected['email'])->get();

        $this->assertIsObject($subject);
    }

    public function test_a_subject_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $subject = Subject::factory()->create();

        $subject->first_name = 'Jerome';
        $subject->last_name = 'Brogani';
        $subject->email = 'gani@gmail.com';
        $subject->nationality = 'Ugandan';
        $subject->date_of_birth = '2000-06-12';
        $subject->phone = '0782444844';
        $subject->next_of_kin = 'Vanessa Hayes';
        $subject->next_of_kin_phone = '0773285731';
        $subject->id_number = 'CM929F45HY2315D';
        $subject->id_type = 'Drivers license';
        $subject->update();

        $subjectData = [
            'first_name' => 'Andrew',
            'last_name' => 'Mugisha',
            'email' => 'andrew@gmail.com',
            'nationality' => 'Ugandan',
            'date_of_birth' => '1995-05-11',
            'phone' => '0783467345',
            'next_of_kin' => 'Frank Mwebaze',
            'next_of_kin_phone' => '0758765745',
            'unique_id' => 'qw3y-674h-yr54-56tf',
            'id_number' => 'CM9141523161023K',
            'id_type' => 'National ID'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch('/subjects/' . $subject->id, $subjectData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Subjects/Index')
                    ->has('subjects')
                    ->has('trashedSubjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $updatedSubject = Subject::find($subject->id);
        $this->assertIsObject($updatedSubject);

        $this->assertEquals($updatedSubject->first_name, $subjectData['first_name']);
        $this->assertEquals($updatedSubject->last_name, $subjectData['last_name']);
        $this->assertEquals($updatedSubject->email, $subjectData['email']);
        $this->assertEquals($updatedSubject->nationality, $subjectData['nationality']);
        $this->assertEquals($updatedSubject->date_of_birth, $subjectData['date_of_birth']);
        $this->assertEquals($updatedSubject->phone, $subjectData['phone']);
        $this->assertEquals($updatedSubject->next_of_kin, $subjectData['next_of_kin']);
        $this->assertEquals($updatedSubject->next_of_kin_phone, $subjectData['next_of_kin_phone']);
        $this->assertEquals($updatedSubject->id_number, $subjectData['id_number']);
        $this->assertEquals($updatedSubject->id_type, $subjectData['id_type']);
    }

    public function test_a_subject_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $subject = Subject::factory()->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->delete('/subjects/' . $subject->id . '/trash')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Subjects/Index')
                    ->has('subjects')
                    ->has('trashedSubjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertCount(0, Subject::all());
    }

    public function test_a_subject_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $subject = Subject::factory()->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->put('/subjects/' . $subject->id . '/restore')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Subjects/Index')
                    ->has('subjects')
                    ->has('trashedSubjects')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertCount(1, Subject::all());
    }
}
