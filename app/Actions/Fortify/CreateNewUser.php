<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'nationality' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'next_of_kin' => ['required', 'string', 'max:255'],
            'next_of_kin_phone' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:255'],
            'id_type' => ['required', 'string', 'max:255']
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nationality' => $input['nationality'],
            'date_of_birth' => $input['date_of_birth'],
            'next_of_kin' => $input['next_of_kin'],
            'next_of_kin_phone' => $input['next_of_kin_phone'],
            'id_number' => $input['id_number'],
            'id_type' => $input['id_type'],
        ]);
    }
}
