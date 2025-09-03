<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request){
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), 
        ]);

        $token = auth('api')->login($user);
        return $this -> respondWithToken($token);
    }
   
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = $this->guard()->user(); // লগইন করা user
            return $this->respondWithToken($token, $user);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token, $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }  
}