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

Route::get('/password/reset/{token?}',['uses'=>'LoginController@showResetForm']);
Route::post('/password/reset_password',['uses'=>'LoginController@changePasswordReset']);
Route::post('/password_reset/send_mail',['uses'=>'LoginController@sendMailForPasswordReset']);


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

    Route::any('/stock/save_product',[
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

    Route::post('/stock/search_filter',[
        'uses' => 'StockController@search',
        'as' => 'stock.search_filter'
    ]);

    Route::get('/stock/get_all_products/{category}/{brand}',[
       'uses' => 'StockController@getProducts',
        'as' => 'getAllProducts'
    ]);

    Route::get('/home/get_products',['uses'=>'StockController@getProductsName']);



    Route::post('/stock/add_brand',[
      'uses'=>'StockController@addNewBrand',
      'as'=>'stock.add_brand'
    ]);

    Route::post('/stock/add_category',[
      'uses'=>'StockController@addNewCategory',
      'as'=>'stock.add_category'
    ]);

    Route::get('/stock/get_all',[
       'uses'=>'StockController@getAll'

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

    Route::post('/todo/edit_status',[
        'uses'=>'TasksController@editStatus',
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
        'as' => 'sellings'
    ]);

    Route::get('/sales/filter_date/{date}',[
        'uses'=>'SellingController@filterDate'
    ]);

    Route::get('/sales/filter_user/{id}',[
        'uses'=>'SellingController@filterUser'
    ]);

    Route::get('/sales/refresh_sales',[
        'uses' => 'SellingController@getSales'
    ]);

    Route::get('/sales/sales_filter/{user}/{year}/{month}/{date}',['uses'=>'SellingController@salesFilter']);
    Route::get('/sales/export_excel/{user}/{year}/{month}/{date}',['uses'=>'SellingController@exportToExcel']);
    Route::any('/sales/export_pdf/{user}/{year}/{month}/{date}',['uses'=>'SellingController@exportToPDF']);

    Route::post('/todo/delete_task',[
        'uses' => 'TasksController@deleteTask',
        'as' =>'tasks.delete_task'
    ]);

    Route::any('/stock/sell_product',[
        'uses' => 'StockController@sellProduct',
        'as' => 'stock.sell_product'
    ]);

    Route::get('/sales/download_excel_file/{file}',['uses'=>'SellingController@downloadExcelFile','as'=>'excel']);
    Route::get('/sales/download_pdf_file/{file}',['uses'=>'SellingController@downloadPdfFile','as'=>'pdf']);


    Route::get('/get_user_stats',['uses'=>'HomeController@getUserStats']);

    Route::get('/getsize/{year}/{month}',['uses'=>'UsersController@getCountByDate','as'=>'getsize']);

    Route::any('stock/search_category_brand',['uses'=>'StockController@getProductsByBrandOrCategory']);



});
