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

Route::get('/', 'PagesController@welcome');

Route::get('admin/', 'Admin\PagesController@admin');

Route::resource('admin/poll', 'Admin\PollController');
Route::resource('admin/research', 'Admin\ResearchController');
Route::resource('admin/participant', 'Admin\ParticipantController');

//Auth::routes();
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::get('admin/logout', 'Auth\LoginController@logout')->name('logout');

/*
Route::post('/admin/poll-share/', 'Admin\PollController@share');
*/

// --------------------------

Route::get('/poll/token/{token}', 'PollController@enter');
Route::get('/poll/start', 'PollController@start');
Route::get('/poll/user', 'PollController@user');
Route::post('/poll/user', 'PollController@storeUser');

Route::get('/poll/screen', 'PollController@screen');
Route::post('/poll', 'PollController@store');
Route::get('/poll/end', 'PollController@end');
Route::post('/poll/share', 'PollController@share');
