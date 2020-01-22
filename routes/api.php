<?php

use Illuminate\Http\Request;

Route::post('loginUser', 'UserController@loginUser');

Route::post('createUser', 'UserController@createUser');

Route::post('rememberPassword', 'UserController@rememberPassword');

Route::get('restaurantToBBDD', 'RestaurantController@index');

Route::group(['middleware' => ['auth']], function () {
    //Route::post('showApps', 'ApplicationsController@showApps');
});