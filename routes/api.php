<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/profiles', [App\Http\Controllers\ProfilesController::class, 'create']);
Route::get('/profiles/{id}', [\App\Http\Controllers\ProfilesController::class, 'find']);
Route::put('/profiles/{id}', [App\Http\Controllers\ProfilesController::class, 'update']);
Route::delete('/profiles/{id}', [App\Http\Controllers\ProfilesController::class, 'delete']);
