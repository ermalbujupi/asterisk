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

Route::any('/password_reset/send_mail',[
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

    Route::any('/user/change_password',[
        'uses'=>'LoginController@changePassword',
        'as' =>'user.change_password'
    ]);



    Route::get('/todo',[
       'uses'=>'TasksController@getAllTasks',
        'as'=>'todo'
    ]);

    Route::any('/todo/save_task',[
        'uses'=>'TasksController@saveTask',
        'as'=>'todo.save_task'
    ]);

    Route::get('/categories_brands',[
        'uses' =>'CatBrandsController@getAll',
        'as' => 'categories_brands'
    ]);



    Route::post('/categories_brands/get_brand',[
        'uses' =>'CatBrandsController@findBrand',
        'as' =>'categories_brands.get_brand'
    ]);

    Route::post('/categories_brands/get_category',[
        'uses' =>'CatBrandsController@findCategory',
        'as' =>'categories_brands.get_category'
    ]);


    Route::post('/categories_brands/edit_category',[
        'uses' =>'CatBrandsController@editCategory',
        'as' =>'categories_brands.edit_category'
    ]);

    Route::post('/categories_brands/edit_brand',[
        'uses' =>'CatBrandsController@editBrand',
        'as' =>'categories_brands.edit_brand'
    ]);

    Route::post('/categories_brands/delete_brand',[
        'uses' => 'CatBrandsController@deleteBrand',
        'as' => 'categories_brands.delete_brand'
    ]);

    Route::post('/categories_brands/delete_category',[
        'uses' => 'CatBrandsController@deleteCategory',
        'as' => 'categories_brands.delete_category'
    ]);

    Route::get('/sales',[
        'uses'=>'SellingController@getAll',
        'as' => 'sellings']);

    Route::post('/todo/delete_task',[
        'uses' => 'TasksController@deleteTask',
        'as' =>'tasks.delete_task'
    ]);

    Route::post('/stock/sell_product',[
        'uses' => 'StockController@sellProduct',
        'as' => 'stock.sell_product'
    ]);


    Route::get('/get_dates',['uses'=>'UsersController@getDateOfCreatedUsers']);

    Route::get('/getsize/{year}/{month}',['uses'=>'UsersController@getCountByDate','as'=>'getsize']);

    Route::any('stock/search_category_brand',['uses'=>'StockController@getProductsByBrandOrCategory']);

});
