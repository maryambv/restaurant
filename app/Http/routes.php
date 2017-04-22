<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//Route::get('/', function () {
//    return view('admin.foods.index');
//});

Route::auth();

Route::get('/', 'HomeController@index');

Route::group(['middleware'=>'admin'], function (){

    Route::resource('admin/users','AdminUserController');
    Route::resource('admin/foods','AdminFoodController');
    Route::resource('admin/categories','AdminCategoryController');
    Route::resource('admin/menu','AdminMenuController');

});

Route::resource('admin/media','AdminMediaController');



Route::get('user/create', ['as' => 'user.create', 'uses' => "UserController@create"]);
Route::Post('user', ['as' => 'user.store', 'uses' => "UserController@store"]);
Route::get('user', ['as' => 'user.index', 'uses' => "UserController@index"]);



Route::group(['middleware'=>'user'], function () {


    Route::get('user/edit', ['as' => 'user.edit', 'uses' => "UserController@edit"]);

    Route::put('user/update', ['as' => 'user.update', 'uses' => "UserController@update"]);
    Route::delete('user/delete', ['as' => 'user.destroy', 'uses' => "UserController@destroy"]);
});