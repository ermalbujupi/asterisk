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

Route::get('/password_reset',function(){
    return view('password_reset');
});

Route::post('/password_reset/send_mail',[
  'uses'=>'LoginController@sendMailForPasswordReset',
  'as' =>'password_reset.send_mail'
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

    Route::get('/stock',[
      'uses' =>'StockController@getAllProducts',
      'as' =>'stock'
    ]);

    Route::post('/stock/save_product',[
       'uses'=>'StockController@saveProduct',
       'as'=>'stock.save_product'
   ]);

   Route::post('/stock/get_product/',[
        'uses' => 'StockController@getProduct',
        'as' => 'stock.get_product'
    ]);

   Route::post('/stock/edit_product',[
       'uses' => 'StockController@editProduct',
       'as' => 'stock.edit_product'
   ]);

   Route::post('/stock/delete_product',[
            'uses' => 'StockController@deleteProduct',
            'as' =>'stock.delete_product'
    ]);

    Route::post('/stock/search_word',[
        'uses' => 'StockController@search',
        'as' => 'stock.search_word'
    ]);

    Route::get('/stock/get_all_products',[
       'uses' => 'StockController@getProducts',
        'as' => 'getAllProducts'
    ]);

    Route::post('/stock/add_brand',[
      'uses'=>'StockController@addNewBrand',
      'as'=>'stock.add_brand'
    ]);

    Route::post('/stock/add_category',[
      'uses'=>'StockController@addNewCategory',
      'as'=>'stock.add_category'
    ]);

    Route::any('/users/save_user',[
        'uses' =>'UsersController@saveUser',
        'as' => 'users.save_user'
    ]);

    Route::post('/users/get_user',[
        'uses' =>'UsersController@getUser',
        'as' => 'users.get_user'
    ]);


    Route::post('/users/edit_user',[
       'uses' => 'UsersController@editUser',
       'as' => 'users.edit_user'
   ]);

   Route::post('/users/delete_user',[
       'uses' =>'UsersController@deleteUser',
       'as' =>'user.delete_user'
   ]);



    Route::get('/todo',[
       'uses'=>'TasksController@getTaskPage',
        'as'=>'todo'
    ]);


});
