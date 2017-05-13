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


Route::auth();

Route::get('/', 'HomeController@index');

Route::group(
    ['middleware'=>'admin'], function () {
        Route::resource('admin/users', 'AdminUserController');
        Route::resource('admin/foods', 'AdminFoodController');
        Route::resource('admin/categories', 'AdminCategoryController');
        Route::resource('admin/menu', 'AdminMenuController');
        Route::resource('admin/static/menu', 'AdminStaticMenuController');
        Route::get(
            'admin/orders',
            ['as' => 'admin.order.index',
            'uses' => "AdminOrderController@index"]
        );

    }
);



Route::get(
    'user/create',
    ['as' => 'user.create',
        'uses' => "UserController@create"]
);
Route::Post('/user', ['as' => 'user.store', 'uses' => "UserController@store"]);
Route::get('/user', ['as' => 'user.index', 'uses' => "UserController@index"]);





Route::group(
    ['middleware'=>'user'], function () {
        Route::resource('admin/media', 'AdminMediaController');
        Route::get(
            'user/edit',
            ['as' => 'user.edit',
            'uses' => "UserController@edit"]
        );

        Route::put(
            'user/update',
            ['as' => 'user.update',
                'uses' => "UserController@update"]
        );
        Route::delete(
            'user/delete',
            ['as' => 'user.destroy',
                'uses' => "UserController@destroy"]
        );

        Route::resource('/order', 'OrderController');
        Route::get(
            'order/show',
            ['as' => 'order.show',
                'uses' => "OrderController@Show"]
        );

        Route::post(
            '/order/pay',
            ['as' => 'order.pay',
                'uses' => "OrderController@pay"]
        );
        Route::get(
            'user/edit',
            ['as' => 'user.edit',
                'uses' => "UserController@edit"]
        );
        Route::post(
            'user/credit',
            ['as' => 'user.credit',
                'uses' => "UserController@credit"]
        );

        Route::get(
            'user/edit/credit',
            ['as' => 'user.charge.credit',
                'uses' => "UserController@editCredit"]
        );
        Route::get('/ordered', 'OrderController@showOrder');

        Route::get('/total', 'OrderController@getTotal');

        Route::get(
            'user/menu/{day}',
            ['as' => 'user.menu',
                'uses' => "UserController@showMenu"]
        );
    }
);