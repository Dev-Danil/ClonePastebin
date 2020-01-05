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
    return view('welcome');
});

Route::get('/add/', function () {
//    return('123');
    return view('add');
});

//Route::get('/list/', function () {
//    $pastes = App\Paste::index();
//    return view('list', compact('pastes'));
//});

Route::get('/add', 'PastesController@add')->name('pasteFilling');
Route::post('/add', 'PastesController@store')->name('pasteStore');

Route::get('/single/{id}', 'PastesController@showSingle');
//Route::get('/single/{id}', function ($id){
//    $paste = DB::table('pastes')->find($id);
//    return view('single', compact('paste'));
//});

Route::get('/list', 'PastesController@index')->name('pasteList');
Route::get('/create', 'PastesController@create')->name('pasteCreate');