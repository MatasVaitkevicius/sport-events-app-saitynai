<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('/type', 'App\Http\Controllers\TypeController');
// Route::apiResource('type/{typeId}/event', 'App\Http\Controllers\EventController');
// Route::apiResource('type/{typeId}/event/comment', 'App\Http\Controllers\CommentController');
// Route::apiResource('/user', 'App\Http\Controllers\UserController');
// Route::post('auth/login', ['uses' => 'AuthController@login', 'as' => 'login']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::resource('types', 'App\Http\Controllers\TypeController');
    Route::resource('types.events', 'App\Http\Controllers\EventController');
    Route::resource('types.events.comments', 'App\Http\Controllers\CommentController');
});
