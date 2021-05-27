<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A feature test RequiredFieldsForRegistration ensures that all fields for registration
     * process are filled accordingly.
     *
     * @return void
     */

    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/register', [], ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'first_name' => ['The first name field is required.'],
                    'last_name' => ['The last name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                    'nationality' => ['The nationality field is required.'],
                    'date_of_birth' => ['The date of birth field is required.'],
                    'user_mobile' => ['The user mobile field is required.'],
                    'next_of_kin' => ['The next of kin field is required.'],
                    'next_of_kin_mobile' => ['The next of kin mobile field is required.']
                ]
            ]);
    }

    /**
     * A feature test RepeatPassword mandates a user to repeat passwords. This repeated 
     * password must match the first one for this test to pass.
     *
     * @return void
     */

    public function testRepeatPassword()
    {
        $userData = [
            "first_name" => "Emmanuel",
            "last_name" => "Atungire",
            "email" => "patungire@gmail.com",
            "password" => "pa12345678",
            'nationality' => 'Ugandan',
            'date_of_birth' => '1998-09-21',
            'user_mobile' => '0773784676',
            'next_of_kin' => 'Andrew Rugamba',
            'next_of_kin_mobile' => '0753578647',
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.']
                ]
            ]);
    }

    /**
     * A feature test SuccessfulRegistration which is populated with dummy data to ensure that
     * users can signup successfully.
     *
     * @return void
     */
    public function testSuccessfulRegistration()
    {
        $userData = [
            'first_name' => 'Emmanuel',
            'middle_name' => 'Nkundwa',
            'last_name' => 'Atungire',
            'email' => 'patungire@gmail.com',
            'password' => 'pa12345678',
            'password_confirmation' => 'pa12345678',
            'nationality' => 'Ugandan',
            'date_of_birth' => '1998-09-21',
            'user_mobile' => '0773784676',
            'next_of_kin' => 'Andrew Rugamba',
            'next_of_kin_mobile' => '0753578647'
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "status",
                "data" => [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'email',
                    'nationality',
                    'date_of_birth',
                    'user_mobile',
                    'next_of_kin',
                    'next_of_kin_mobile',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
                "message"
            ]);
    }

    /**
     * A feature test MustEnterEmailAndPassword ensures that the required fields are not left
     * empty by the user.
     *
     * @return void
     */

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }


    /**
     * A feature test SuccessfulLogin ensures a dummy user created ascertains that the user 
     * is authenticated successfully.
     *
     * @return void
     */

    public function testSuccessfulLogin()
    {
        factory(User::class)->create([
            'email' => 'sample@test.com',
            'password' => bcrypt('sample123'),
        ]);

        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'email',
                    'email_verified_at',
                    'nationality',
                    'date_of_birth',
                    'user_mobile',
                    'next_of_kin',
                    'next_of_kin_mobile',
                    'created_with',
                    'updated_with',
                    'created_at',
                    'updated_at',
                ],
                'access_token',
                'message'
            ]);

        $this->assertAuthenticated();
    }
}
