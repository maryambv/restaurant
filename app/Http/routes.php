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

Route::get('/', function () {
    return view('admin.foods.index');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('admin/users','AdminUserController');
Route::resource('admin/media','AdminMediaController');
Route::resource('admin/foods','AdminFoodController');
Route::resource('admin/categories','AdminCategoryController');
Route::resource('admin/menu','AdminMenuController');
