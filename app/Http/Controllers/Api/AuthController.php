<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        event(new Registered($user));

        return response()->json(New UserResource($user),201);
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
    
    public function user(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
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

    public function updateInfo(UpdateUserInfoRequest $request)
    {

        $request->validated();

        $user = $request->user();

        $user->update($request->only('name','email'));

        return response()->json(New UserResource($user),202);
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $request->validated();
        
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        $user->tokens()->delete();

        $cookie = \Cookie::forget('jwt');

        return response()->json(New UserResource($user),202);
    }

}
