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
    return view('dashboard');
});

Route::get('dashboard-menu', 'dashboardController@index')->name('dashboard');
Route::get('charts-chartArea', 'chartController@index')->name('chart');
Route::get('table-menu', 'tableController@index')->name('table');

Route::delete('staff/{id}', 'tableController@destroy');
Route::delete('staffDeleteAll', 'tableController@deleteAll');