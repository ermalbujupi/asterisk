<?php
use Illuminate\Support\Facades\Route;
Route::get('login',[
    'uses'=>'LoginController@getLogin',
    'as'=>'login'
]);

Route::post('login',[
    'uses'=>'LoginController@login',
    'as'=>'login'
]);

Route::any('logout',[
    'uses'=>'LoginController@logout',
    'as'=>'logout'
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/',[
        'uses'=>'HomeController@getIndex',
        'as'=>'index'
    ]);
    
    Route::get('/users',[
        'uses'=>'UsersController@getUsers',
        'as'=>'users'
    ]);
});
