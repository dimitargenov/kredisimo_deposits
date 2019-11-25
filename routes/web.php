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

Route::get('depozit', 'DepozitController@index')->name('depozit.index');
Route::post('select-client', ['as'=>'select-client','uses'=>'DepozitController@selectClient']);
Route::post('add-depozit', ['as'=>'add-depozit','uses'=>'DepozitController@add']);

Route::get('report', 'ReportController@index')->name('report.index');
Route::get('report/create', 'ReportController@create')->name('report.create');
