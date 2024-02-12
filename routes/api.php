<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DogsController;
use App\Http\Controllers\Api\FeedbacksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function() {
    $data = [
        'message' => "Welcome to our API"
    ];
    return response()->json($data, 200);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dogs', [DogsController::class, 'index']);
Route::get('/dogs/{id}', [DogsController::class, 'show']);

Route::get('/feedbacks', [FeedbacksController::class, 'index']);
Route::get('/feedbacks/{id}', [FeedbacksController::class, 'show']);

Route::middleware('role')->group(function() {
    Route::post('/register-admin', [AuthController::class, 'registerAdmin']);

    Route::post('/dogs', [DogsController::class, 'store']);
    Route::put('/dogs/{id}', [DogsController::class, 'update']);
    Route::delete('/dogs/{id}', [DogsController::class, 'destroy']);

    Route::post('/feedbacks', [FeedbacksController::class, 'store']);
    Route::put('/feedbacks/{id}', [FeedbacksController::class, 'update']);
    Route::delete('/feedbacks/{id}', [FeedbacksController::class, 'destroy']);

});

Route::middleware('jwt.verify')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});