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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Boards
Route::get('/boards', 'BoardController@index')->name('boards');
// Board
Route::get('/board/{link}', 'BoardController@show')->name('board');


// Create boards
Route::get('/boards/create', 'BoardController@create')->name("board.create");
Route::post('/boards/create', 'BoardController@store')->name("board.store");


// Threads
Route::post('/threads/create', 'ThreadController@store')->name("thread.create");