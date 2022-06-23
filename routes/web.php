<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JobOffersController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use Illuminate\Auth\Middleware\Authenticate;
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

//route for search result request
Route::get('/search', [SearchController::class, 'show'])->name('search.result');

//show detailed information for a single listing
Route::get('/listing/{id}', [JobOffersController::class, 'show']);

//registration routes
Route::get('/register', [UsersController::class, 'create'])->middleware('guest')->name('register');
Route::post('/users', [UsersController::class, 'store'])->middleware('guest')->name('create.user');

//login and auth routes
Route::get('/login', [UsersController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login/auth', [UsersController::class, 'authenticate'])->middleware('guest')->name('auth.user');
Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth')->name('logout');

//show profile page
Route::post('/profile', [UsersController::class, 'index'])->middleware('auth')->name('profile');

//add experience entry
Route::post('/experience/add', [ExperienceController::class, 'store'])->middleware('auth')->name('experience');

//add education entry
Route::post('/education/add', [EducationController::class, 'store'])->middleware('auth')->name('education');