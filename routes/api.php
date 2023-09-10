<?php

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//USUARIO
Route::middleware('ifToken')->get('usuario', [authController::class, 'userProfile']);
Route::post('registro', [authController::class, 'registro']);
Route::put('usuario/{id}', [authController::class, 'udpate']);
Route::post('auth', [authController::class, 'login']);
Route::middleware('ifToken')->post('logout', [authController::class, 'logout']);


//ROLES
Route::middleware('ifAdmin')->get('roles', [RolesController::class, 'index']);
Route::get('roles/{id}', [RolesController::class, 'show']);
Route::post('roles', [RolesController::class, 'store']);
Route::put('roles/{id}', [RolesController::class, 'udpate']);
Route::delete('roles/{id}', [RolesController::class, 'destroy']);
