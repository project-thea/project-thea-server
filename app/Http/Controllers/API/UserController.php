<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validationRules = [
            'first_name' => 'required|string|max:55',
            'middle_name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'email|required|string|unique:users',
            'password' => 'required|string|confirmed',
            'nationality' => 'required|string|max:55',
            'date_of_birth' => 'before:yesterday',
            'user_mobile' => 'required|string|max:12',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_mobile' => 'required|string|max:55'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
            'message' => 'Registered Successfully'
        ], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Login Credentials'], 401);
        }

        //Once authenticated successfully, an accessToken is generated to identify 
        //the currently logged in user
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $accessToken,
            'message' => 'Login Successful'
        ], 200);
    }

    public function logout(Request $request)
    {
        $authToken = $request->user()->token();
        $authToken->revoke();
        return response(['message' => 'You have successfully logged out']);
    }
}
