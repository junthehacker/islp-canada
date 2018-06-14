<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

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

Route::get('/portal/users', 'PortalController@usersPage')->name('users')->middleware('admin');
Route::get('/portal/mentorapplications', 'PortalController@mentorApplicationsPage')->name('mentorapplications')->middleware('admin');
Route::get('/portal/mentorapplications/detail/{id}', 'PortalController@mentorApplicationDetailsPage')->name('mentorapplications')->middleware('admin');
Route::get('/portal/submissions', 'PortalController@submissionsPage')->name('submissions');

// Rubric routes
Route::get('/portal/rubric', 'PortalController@rubricPage')->name('rubric')->middleware('admin');
Route::get('/portal/rubric/{id}', 'PortalController@rubricListingPage')->name('rubric')->middleware('admin');
Route::get('/portal/rubric/{competition_id}/rules/create', 'PortalController@createRubricRulePage')->name('rubric')->middleware('admin');
Route::post('/portal/rubric/{competition_id}/rules/create', 'JudgingRuleController@create')->name('rubric')->middleware('admin');
Route::post('/portal/rubric/{competition_id}/rules/delete', 'JudgingRuleController@delete')->name('rubric')->middleware('admin');
Route::get('/portal/rubric/{competition_id}/rules/edit/{id}', 'PortalController@editRubricRulePage')->name('rubric')->middleware('admin');
Route::post('/portal/rubric/{competition_id}/rules/edit/{id}', 'JudgingRuleController@update')->name('rubric')->middleware('admin');

// Forum
Route::get('/forum', 'ForumController@home');
Route::get('/forum/new', 'ForumController@new');
Route::get('/forum/posts/{id}', 'ForumController@post');

// Competition routes
Route::get('/portal/competitions', 'PortalController@competitionsPage')->name('competitions')->middleware('admin');
Route::post('/portal/competitions/create', 'CompetitionController@create')->name('createCompetition')->middleware('admin');
Route::post('/portal/competitions/status/update/{id}', 'CompetitionController@updateStatus')->name('updateCompetitionStatus')->middleware('admin');


// Judging
Route::get('/portal/judging', 'PortalController@judgingPage')->name('judging')->middleware('admin');
Route::post('/portal/judging/autoassign', 'JudgingResultController@autoAssign')->name('judging')->middleware('admin');

Route::post('/portal/logout', 'PortalController@logout')->name('logout');
Route::post('/portal/users/create', 'PortalController@createUser')->name('createUser');
Route::post('/portal/posters/create', 'PosterController@create')->name('createPoster');
Route::post('/portal/mentors/approve', 'PortalController@approveMentor')->name('approveMentor')->middleware('admin');
Route::post('/portal/mentors/decline', 'PortalController@declineMentor')->name('declineMentor')->middleware('admin');


Route::post('/portal/login', 'UserController@authenticate');
Route::post('/portal/signup/teacher', 'UserController@createTeacherAccount');
Route::post('/portal/signup/mentor', 'UserController@createMentorAccount');