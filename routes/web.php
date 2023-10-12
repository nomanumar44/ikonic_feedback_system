<?php

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Mail\FeedbackInfo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('admin/dashboard', function () {
    return view('layouts.app');
})->middleware(['auth'])->name('admin.dashboard');
Route::get('user/dashboard', function () {
    return view('layouts.userdashboard');
})->middleware(['auth'])->name('user.dashboard');

require __DIR__ . '/auth.php';

Route::view('/{any}', 'dashboard')
    ->middleware('auth')
    ->where('any', '.*');

    // Route::get('send-email-queue', function(){
    //     // $details['email'] = 'nomanumar522@gmail.com';
    //     // dispatch(new SendEmailJob($details));
    //     $details['email'] = 'nomanumar522@gmail.com';
    //     dispatch(new SendEmailJob($details));
    //     return response()->json(['message'=>'Mail Send Successfully!!']);
    // });
