<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request) {
        $fields = $request->validate([
            'login' => 'required|string|max:64|unique:users,login',
            'last_name' => 'required|max:64|string',
            'first_name' => 'required|max:64|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'login' => $fields['login'],
            'last_name' => $fields['last_name'],
            'first_name' => $fields['first_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'id_role' => 2,
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'login' => 'required|string|max:64',
            'password' => 'required|string'
        ]);

        $user = User::where('login', $fields['login'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad Login'
            ], 401);
        }

        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
