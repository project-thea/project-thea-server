<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Helpers\APIHelpers;

class UserController extends Controller
{
    /**
     * This register function takes in a request parameter that is validated and after validation,
     * a user is created together with the authentication access_token that will be used to log in.
     * 
     * */
    public function register(Request $request)
    {
        $validationRules = [
            'first_name' => 'required|string|max:55',
            'middle_name' => 'string|max:55', //Not a must to have this field required
            'last_name' => 'required|string|max:55',
            'email' => 'email|required|string|unique:users',
            'password' => 'required|string|confirmed',
            'nationality' => 'required|string|max:55',
            'date_of_birth' => 'required|before:yesterday',
            'user_mobile' => 'required|string|max:12',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_mobile' => 'required|string|max:55'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accessToken = $user->createToken('authToken')->accessToken;

        $message = 'Registered Successfully';
        $apiResponse = APIHelpers::createAuthResponse(false, $message, $user, $accessToken);
        return response()->json($apiResponse, 201);
    }

    /**
     * This login function ensures that any user created from the registration logic is 
     * is authenticated successfully based on all required fields.
     * 
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Login Credentials.'], 401);
        }

        //Once authenticated successfully, an accessToken is generated to identify 
        //the currently logged in user
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        $message = 'Login Successful';
        $user = auth()->user();
        $apiResponse = APIHelpers::createAuthResponse(false, $message, $user, $accessToken);
        return response()->json($apiResponse, 200);
    }

    /**
     * This logout function ensures that any authenticated user from the request is logged out 
     * successfully together with revoking of their access token.
     * 
     */
    public function logout(Request $request)
    {
        $authToken = $request->user()->token();
        $authToken->revoke();
        return response(['message' => 'You have successfully logged out.']);
    }
}
