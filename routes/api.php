<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post('forgot-password', [PasswordController::class, 'forgot']);
Route::post('reset-password', [PasswordController::class, 'reset']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
});


Route::middleware('auth:sanctum','UserPermission','verified')->group(function () {

    Route::put('/users/info',
        [AuthController::class, "updateInfo"]
    )->name('user-info');

    Route::put('/users/password',
        [AuthController::class, "updatePassword"]
    )->name('user-password');

    Route::get('/users',
        [UserController::class, "index"]
    )->name('view-users');

    Route::post('/users',
        [UserController::class, "store"]
    )->name('store-users');

    Route::get('/users/{id}',
        [UserController::class, "show"]
    )->name('show-user');

    Route::put('/users/{id}',
        [UserController::class, "update"]
    )->name('update-user');

    Route::delete('/users/{id}',
        [UserController::class, "destroy"]
    )->name('delete-user');



    Route::get('/roles',
        [RoleController::class, "index"]
    )->name('view-roles');

    Route::post('/roles',
        [RoleController::class, "store"]
    )->name('store-roles');

    Route::get('/roles/{id}',
        [RoleController::class, "show"]
    )->name('show-role');

    Route::put('/roles/{id}',
        [RoleController::class, "update"]
    )->name('update-role');

    Route::delete('/roles/{id}',
        [RoleController::class, "destroy"]
    )->name('delete-role');



    Route::get('/permissions',
        [PermissionController::class, "index"]
    )->name('view-permissions');


    // Route::apiResource('/categories', CategoryController::class);
    // Route::apiResource('/sub-categories', SubCategoryController::class);

});

