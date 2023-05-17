<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);
        return response()->json([
            'data' => [
                'user' => $user->first_name . ' ' . $user->last_name,
                'token' => $user->createToken('token')->plainTextToken
            ],
            'message' => 'Success',
        ], 200);
    }

    public function login(UserLoginRequest $request)
    {
        return (Auth::attempt($request->all())) ? $this->authenticatedUser() :
            $this->unAuthenticated();
    }

    private function authenticatedUser()
    {
        $user = User::find(auth()->id());
        return response()->json([
            'data' => [
                'user' => $user->first_name . ' ' . $user->last_name,
                'token' => $user->createToken('token')->plainTextToken
            ],
            'message' => 'Success',
        ], 200);
    }

    private function unAuthenticated()
    {
        return response()->json([
            'message' => 'Email or password is incorrect',
        ], 400);
    }
}
