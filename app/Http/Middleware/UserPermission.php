<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
class UserPermission
{
    public function handle(Request $request, Closure $next)
    {
        $role = Auth::user()->role;

        if ($role->id != 1) {
            foreach ($role->permissions as $permission) {

                if (Route::getFacadeRoot()->current()->getName() == $permission->name) {
                    return $next($request);
                }
            }

            return response()->json([
                'message' => 'This action is unauthorized'
            ], 403);

        }else{
            return $next($request);
        }




    }
}
