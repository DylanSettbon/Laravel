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


Route::resource('/group','GroupController');

Route::get('edit/{id}', 'GroupController@edit')->name("editGroup");

Route::post('update', 'GroupController@update')->name("updateGroup");


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return view('welcome');
});

Route::get('/chat', function () {
    return view('welcome');
});

Route::get('/friends', 'FriendsController@showFriends');

Route::get('/addedFriends', 'FriendsController@getDemand');

Route::get('/acceptFriend/{idAccepted}', 'FriendsController@acceptDemand');

Route::post('/add', function () {
    return view('welcome');
});

Route::get('/friends', function () {
    return view('welcome');
});


Route::post('/search', 'SearchController@search');
Route::post('/searchfriends', 'SearchController@searchFriends');


Route::post('/add/{idReceived}','RelationController@add');

//Route::post('/edit/{', 'GroupController@edit');



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    //Route::get('createConv', ['as' => 'messages.createConv', 'uses' => 'MessagesController@createConv']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
