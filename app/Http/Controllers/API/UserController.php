<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * This register function takes in a request parameter that is validated and after validation,
     * a user is created together with the authentication access_token that will be used to log in.
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\Request
     * */
    public function register(Request $request)
    {
        $validationRules = [
            'first_name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'email|required|string|unique:users',
            'password' => 'required|string|confirmed'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accessToken = $user->createToken('authToken')->plainTextToken;

        $apiResponse = APIHelpers::formatAuthResponse(false, 'Registered Successfully', $user, $accessToken);
        return response()->json($apiResponse, 201);
    }

    /**
     * This login function ensures that any user created from the registration logic is 
     * is authenticated successfully based on all required fields.
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\Request
     */
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required|string'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json(['message' => 'Invalid login credentials.'], 401);
        }

        //check the email and get the first result
        $user = User::where('email', $loginData['email'])->first();

        $accessToken = $user->createToken('authToken')->plainTextToken;

        $apiResponse = APIHelpers::formatAuthResponse(false, 'Login Successful', $user, $accessToken);
        return response()->json($apiResponse, 200);
    }

    /**
     * This logout function ensures that any authenticated user from the request is logged out 
     * successfully together with revoking of their access token.
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\Request
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message' => 'You have successfully logged out.']);
    }
}
