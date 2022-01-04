<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        event(new Registered($user));

        return response()->json([
            'user' => $user
        ],201);
    }

    public function login(LoginRequest $request){

        $request->validated();
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Invalid Credentials'
            ],401);
        }

        $user = Auth::user();

        $jwt = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt',$jwt, 60 *24);

        return response()->json([
            'jwt' => $jwt
        ])->withCookie($cookie);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();

        $cookie = \Cookie::forget('jwt');

        return response()->json([
            'message' => 'success'
        ])->withCookie($cookie);

    }
}