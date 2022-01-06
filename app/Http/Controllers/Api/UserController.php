<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::with('role')->paginate()) ;
    }


    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('12345');
        $user->role_id = $request->role_id;
        $user->save();

        event(new Registered($user));

        return response()->json(New UserResource($user),201);
    }


    public function show($id)
    {
        return New UserResource(User::with('role')->find($id));
    }


    public function update(UpdateUserRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);

        $user->update($request->only('name','status_id'));

        return response()->json(New UserResource($user),202);
    }


    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null,204);
    }
}
