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


Auth::routes(['register'=>false]);

Route::get('/', 'HomeController@index')->name('home');

Route::resource('/employees', 'EmployeeController');
Route::post('/employees/status','EmployeeController@status');
Route::post('/employees/search', 'EmployeeController@search');