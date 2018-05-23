<?php

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
    return view('home');
})->name('landing.home');

Route::get('/portal/login', 'UserController@loginPage')->name('login');

Route::get('/portal/dashboard', 'PortalController@dashboardPage')->name('dashboard');
Route::get('/portal/account', 'PortalController@accountPage')->name('account');
Route::get('/portal/users', 'PortalController@usersPage')->name('users');
Route::get('/portal/submissions', 'PortalController@submissionsPage')->name('submissions');
Route::post('/portal/logout', 'PortalController@logout')->name('logout');
Route::post('/portal/users/create', 'PortalController@createUser')->name('createUser');
Route::post('/portal/posters/create', 'PosterController@create')->name('createPoster');


Route::post('/portal/login', 'UserController@authenticate');
Route::post('/portal/signup/teacher', 'UserController@createTeacherAccount');