<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function index()
    {
        return RoleResource::collection(Role::all());
    }


    public function store(Request $request)
    {
        $request->validated();

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return response()->json(New RoleResource($role),201);
    }


    public function show($id)
    {
        return New RoleResource(Role::with('permissions')->find($id));
    }


    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $role->name = $request->name;
        $role->save();

        return response()->json(New RoleResource($role),202);
    }


    public function destroy($id)
    {
        Role::destroy($id);
        return response()->json(null,204);
    }
}
