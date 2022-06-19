<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [SearchController::class, 'index']);

//search routes
Route::post('/show', 'App\Http\Controllers\SearchController@show');
Route::get('/listing/{id}', [SearchController::class, 'show']);

//login and registration routes
Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::get('/login', [UsersController::class, 'login'])->name('login');
