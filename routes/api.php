<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ParticipationsController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('participant', ParticipantController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'sendPasswordResetLink']);

Route::post('/reset/password', [AuthController::class, 'callResetPassword']);
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'details']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/updateprofile', [UserController::class, 'updateProfile']);
    Route::get('/getevent', [EventController::class, 'index']);
    Route::get('/searchpanel/{event}', [EventController::class, 'searchPanel']);
    Route::post('/participateinevent', [ParticipationsController::class, 'participateInEvent']);
    Route::get('/getnames', [UserController::class, 'getNames']);
});
