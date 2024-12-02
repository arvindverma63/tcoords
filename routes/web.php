<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LinkedInController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/signIn',[AuthController::class,'signIn']);
Route::get('/login',[AuthController::class,'login']);

Route::get('/callback',[AuthController::class,'callback']);
Route::get('auth/linkedin', [LinkedInController::class, 'redirectToLinkedIn']);
Route::get('auth/linkedin/callback', [LinkedInController::class, 'handleLinkedInCallback']);
