<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[AuthController::class,'signIn']);
Route::get('/login',[AuthController::class,'login']);

Route::get('/callback',[AuthController::class,'callback']);
Route::get('linkedin/auth', [LinkedinController::class, 'handleLinkedinAuthentication'])->name('linkedin.auth');
Route::get('linkedin/auth/callback', [LinkedinController::class, 'handleLinkedinCallback']);
Route::get('dashboard',[AuthController::class,'index']);
Route::get('/team',[TeamController::class,'team']);
