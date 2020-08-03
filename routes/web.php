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
/*admin route using middle ware*/


Route::get('/','Index\IndexController@index');


//listing products
Route::get('/product/{url}','Admin\ProductsController@products');
 
//product details page
Route::get('products/{url}','Admin\ProductsController@product')->name('product.detail');

//cart page
Route::match(['get','post'],'/cart','Admin\ProductsController@cart');

//add to cart rout
Route::match(['get','post'],'/add-cart','Admin\ProductsController@addtocart');

//delete product from cart
Route::get('/cart/delete-product/{id}','Admin\ProductsController@deletecart');

//Quantity increase or decrease
Route::get('/cart/update-quantity/{id}/{quantity}','Admin\ProductsController@updateCartQuantity');


//GET product attributes
Route::get('/get-product-price','Admin\ProductsController@getProductPrice');
///
///
//user login and register route
Route::get('/login-register','Frontuser\UsersController@userloginregister');
Route::post('/user-register','Frontuser\UsersController@register');

//Logout user
Route::get('/user-logout','Frontuser\UsersController@logout');

//Login user
Route::post('/user-login','Frontuser\UsersController@login');

//user accounts page
Route::group(['middleware' => ['frontlogin']],function(){
    Route::match(['get','post'],'/account','Frontuser\UsersController@account');
    Route::post('/check-user-pwd','Frontuser\UsersController@chkUserPassword');
    Route::post('/update-user-pwd','Frontuser\UsersController@updatePassword');
    Route::match(['get','post'],'/checkout','Admin\ProductsController@checkout');
    Route::match(['get','post'],'/order-review','Admin\ProductsController@orderReview');
    Route::match(['get','post'],'/review/{id}','Admin\ProductsController@review');
    
});
 Route::get('/search','Admin\ProductsController@search');


//Admin Controll route
Route::group(['middleware' => ['auth','admin']],function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/role-register','Admin\DashboardController@registered');
    Route::get('/role-edit/{id}','Admin\DashboardController@registeredit');
    Route::put('/role-updated/{id}','Admin\DashboardController@registerupdate');
    Route::delete('/role-delete/{id}','Admin\DashboardController@registerdelete');
    
    //categories routing
    Route::get('/categories','Admin\CategoriesController@index');

    Route::post('/save-categories','Admin\CategoriesController@store');
    Route::get('/edit-category/{id}','Admin\CategoriesController@edit');

    Route::put('/category-edit/{id}','Admin\CategoriesController@update');

    Route::delete('/delete-category/{id}','Admin\CategoriesController@delete');


    //products routing
    Route::match(['get','post'],'/products','Admin\ProductsController@add_Product');
    Route::get('/editimage/{id}','Admin\ProductsController@edit');
    Route::put('/product-edit/{id}','Admin\ProductsController@update');
    Route::delete('/delete-product/{id}','Admin\ProductsController@delete');

    //ProductsAttribute routing
    Route::match(['get','post'],'/add-attribute/{id}','Admin\ProductsController@addAtrributes');
    Route::match(['get','post'],'/add-images/{id}','Admin\ProductsController@addImages');
    Route::delete('/delete-images/{id}','Admin\ProductsController@deleteImages');

    Route::delete('/delete-attribute/{id}','Admin\ProductsController@deleteattribute');
    Route::match(['get','post'],'/edit-attribute/{id}','Admin\ProductsController@editAtrributes'); 
});





/*other route*/
Route::get('/admin', function () {
   return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

