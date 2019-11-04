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

Route::get('/', 'BoardController@home')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


// Boards
Route::get('/boards', 'BoardController@index')->name('boards'); // All boards
Route::get('/boards/sfw', 'BoardController@sfw')->name('boards.sfw'); // SFW boards
Route::get('/boards/nsfw', 'BoardController@nsfw')->name('boards.nsfw'); // NSFW boards
// Board
Route::get('/board/{link}', 'BoardController@show')->name('board');
Route::get('/board/{link}/catalog', 'BoardController@catalog')->name('board.catalog');


// Create boards
Route::group(['middleware'=> ['is_owner']], function(){
    Route::get('/boards/create', 'BoardController@create')->name("board.create");
    Route::post('/boards/create', 'BoardController@store')->name("board.store");
    Route::get('/boards/edit/{link}', 'BoardController@edit')->name("board.edit");
    Route::put('/boards/edit/{link}', 'BoardController@update')->name("board.update");
    Route::delete('/boards/delete/{id}', 'BoardController@destroy')->name("board.delete");
    
    // User
    Route::get('/users', 'UserController@index')->name("users");
    Route::get('/user/{id}', 'UserController@edit')->name("user.edit");
    Route::put('/user/{id}', 'UserController@update')->name("user.update");
    
    
});

// Threads
Route::get('/thread/{id}', 'ThreadController@show')->name("thread");
Route::post('/threads/create', 'ThreadController@store')->name("thread.create");
Route::delete('/threads/delete', 'ThreadController@destroy')->name("thread.delete");

// Comments
Route::post('/comment/create', 'CommentController@store')->name("comment.create");
Route::delete('/comment/delete', 'CommentController@destroy')->name("comment.delete");
