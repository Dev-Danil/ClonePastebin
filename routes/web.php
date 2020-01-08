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
    $tenPastes = App\Paste::getTenLastPublicPastes();
    return view('welcome', compact('tenPastes'));
});

Route::get('/add', 'PastesController@add')->name('pasteFilling');
Route::post('/add', 'PastesController@store')->name('pasteStore');

Route::get('/single/{hash}', 'PastesController@show')->name('single');

Route::get('/list', 'PastesController@index')->name('pasteList');
Route::get('/create', 'PastesController@create')->name('pasteCreate');