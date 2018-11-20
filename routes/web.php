<?php
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }
    return view('users.homes.index');
});
Auth::routes(['verify' => true]);
<<<<<<< HEAD
=======

Route::get('/login', function() {
    return redirect('/');
})->name('login');

>>>>>>> 69d46075933965495846c913d969e82ea0f7871a
Route::get('/profile', function () {
    return 'This is Profile';
})->middleware('verified');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('/carts', 'CartController@index');
Route::middleware(['auth'])->group(function () {
<<<<<<< HEAD
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', 'AdminController@index');
=======
    Route::post('/profile/edit/{id}', 'ProfileController@updateAddress');
    Route::get('/profile/{id}', 'ProfileController@getProfile');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', 'AdminController@index');
        Route::post('/merchantconfirmed/{id}', 'MerchantController@updateConfirm');
        Route::get('/admin/newmerchant', 'MerchantController@newmerchant');
        Route::get('/admin/neworder', 'OrderController@neworder');

>>>>>>> 69d46075933965495846c913d969e82ea0f7871a
        Route::get('/roles', 'RoleController@index');
        Route::post('/roles/store', 'RoleController@store');
        Route::post('/roles/update/{id}', 'RoleController@update');
        Route::get('/permissions', 'PermissionController@index');
        Route::post('/permissions/store', 'PermissionController@store');
        Route::post('/permissions/update/{id}', 'PermissionController@update');

        Route::get('/blog', 'BlogController@index');
        Route::get('/blog/create', 'BlogController@create');
        Route::get('/blog/edit/{id}', 'BlogController@edit');
        Route::post('/blog/delete/{id}', 'BlogController@destroy');
        Route::post('/blog/update/{id}', 'BlogController@update');
        Route::post('/blog/store', 'BlogController@store');
        
        Route::post('/orderconfirm/{id}', 'OrderController@orderconfirm');
    });
    Route::middleware('role:merchant')->group(function () {
        Route::get('/merchant', 'MerchantController@index');
        Route::prefix('/merchant/products')->group(function () {
            Route::get('/', 'MerchantController@products');
        });

        Route::get('/merchant/{id}/orders', 'MerchantController@orders');
    });
    Route::middleware('role:customer')->group(function () {
        Route::post('/carts/delete/{id}', 'CartController@destroy');
        Route::get('/shipping', 'ShippingController@index');
        Route::get('/transactions/{id}', 'TransactionController@show');
    });
    Route::middleware('role:costumer|admin')->group(function () {
    });
    Route::middleware('role:merchant|admin')->group(function () {
        Route::get('/products', 'ProductController@index');
        Route::get('/products/create', 'ProductController@create');
        Route::get('/products/edit/{id}', 'ProductController@edit');
        Route::post('/products/delete/{id}', 'ProductController@destroy');
        Route::post('/products/update/{id}', 'ProductController@update');
        Route::post('/products/store', 'ProductController@store');
        Route::prefix('/orders')->group(function () {
            Route::get('/', 'TransactionController@index');
        });
    });
    Route::middleware('role:merchant|customer')->group(function () {
    });
    Route::get('/home', 'HomeController@index');
});
Route::get('/products/{id}', 'ProductController@show');
Route::get('/search', 'HomeController@search');

Route::get('/search', 'SearchController@index');
Route::get('/search/show');