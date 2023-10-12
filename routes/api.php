<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FeedbackSystem\CommentsController;
use App\Http\Controllers\FeedbackSystem\FeedbackController;
use App\Http\Controllers\FeedbackSystem\UsersController;
use App\Http\Controllers\FeedbackSystem\VoteingController;

// EMPLOYEE MANAGMENT

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
    return response()->json($request->user());
});

Route::controller(UsersController::class)->group(function(){
    Route::apiResource('users',UsersController::class);
    Route::post('upload-image','uploadImage');
    Route::get('/get-product','getProduct');
    Route::get('/get-all-data','getAllData');
});
Route::controller(FeedbackController::class)->group(function(){
    Route::apiResource('feedbacks',FeedbackController::class);
});
Route::controller(CommentsController::class)->group(function(){
    Route::post('add-comment','store');
});
Route::controller(VoteingController::class)->group(function(){
    Route::post('/upvote', 'upvote');
    Route::post('/downvote', 'downvote');
});
// Feedback system routes
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
