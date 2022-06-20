<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JobOffersController;
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
//landing page
Route::get('/', [SearchController::class, 'index']);

//show detailed information for a single listing
Route::get('/listing/{id}', [JobOffersController::class, 'show']);

//registration routes
Route::get('/register', [UsersController::class, 'create'])->name('register');
Route::post('/profile', [UsersController::class, 'store'])->name('create.user');

//login and auth routes
Route::get('/login', [UsersController::class, 'show'])->name('login');
Route::post('/login/auth', [UsersController::class, 'login'])->name('auth.user');
