<?php

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

    Route::get('/stock',[
      'uses' =>'StockController@getAllProducts',
      'as' =>'stock'
    ]);

    Route::post('/stock/save_product',[
       'uses'=>'StockController@saveProduct',
       'as'=>'stock.save_product'
   ]);

});
