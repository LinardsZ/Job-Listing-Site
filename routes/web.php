<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobOfferController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
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

//registration routes
Route::get('/register', [UsersController::class, 'create'])->middleware('guest')->name('register');
Route::post('/users', [UsersController::class, 'store'])->middleware('guest')->name('create.user');

//login and auth routes
Route::get('/login', [UsersController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login/auth', [UsersController::class, 'authenticate'])->middleware('guest')->name('auth.user');
Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth')->name('logout');

//show profile page
Route::post('/profile', [UsersController::class, 'index'])->middleware('auth')->name('profile');

//edit and update user profile
Route::get('/profile/edit', [UsersController::class, 'edit'])->middleware('auth')->name('edit.profile');
Route::post('/profile/update', [UsersController::class, 'update'])->middleware('auth')->name('set.profile');

//add, edit, update and delete experience entries
Route::post('/experience/add', [ExperienceController::class, 'store'])->middleware('auth')->name('experience');
Route::get('/experience/edit/{id}', [ExperienceController::class, 'edit'])->middleware('auth');
Route::post('/experience/update', [ExperienceController::class, 'update'])->middleware('auth')->name('set.exp');
Route::delete('/experience/delete/{id}', [ExperienceController::class, 'destroy'])->middleware('auth');

//add, edit, update and delete education entries
Route::post('/education/add', [EducationController::class, 'store'])->middleware('auth')->name('education');
Route::get('/education/edit/{id}', [EducationController::class, 'edit'])->middleware('auth');
Route::post('/education/update', [EducationController::class, 'update'])->middleware('auth')->name('set.edu');
Route::delete('/education/delete/{id}', [EducationController::class, 'destroy'])->middleware('auth');

//show form for adding and storing a company
Route::get('/company/add', [CompanyController::class, 'index'])->middleware('auth')->name('add.company');
Route::post('/company/add', [CompanyController::class, 'store'])->middleware('auth')->name('store.company');

//edit and update company details
Route::get('company/edit', [CompanyController::class, 'edit'])->middleware('auth')->name('edit.company');
Route::post('company/update', [CompanyController::class, 'update'])->middleware('auth')->name('set.company');

//show detailed information for a single listing
Route::get('/listing/{id}', [JobOfferController::class, 'show']);

//add, edit, update and delete job offers
Route::post('/offer/add', [JobOfferController::class, 'store'])->middleware('auth')->name('add.offer');
Route::get('/offer/edit/{id}', [JobOfferController::class, 'edit'])->middleware('auth')->name('edit.offer');
Route::post('/offer/set', [JobOfferController::class, 'update'])->middleware('auth')->name('set.offer');
Route::delete('/offer/delete/{id}', [JobOfferController::class, 'destroy'])->middleware('auth')->name('delete.offer');