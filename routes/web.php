<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/', function () {
    return view('front.home');
});

Route::get('auth/facebook', 'Auth\SocialController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\SocialController@handleFacebookCallback');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::post('auth', 'HomeController@auth');

Route::group(['namespace' => 'front'], function () {
	Route::get('/', 'HomeController@index');
	Route::post('/home/contact', 'HomeController@contact');

	Route::get('/signin', 'UserController@index');
	Route::post('/signin/login', 'UserController@login');
	Route::get ( '/logout', 'UserController@logout' );
	Route::get('/signup', 'UserController@signup');
	Route::post('/signup/signup', 'UserController@register');
	Route::get ( '/account', 'UserController@account' );
	Route::post ( '/account/updateaccount', 'UserController@updateaccount' );
	Route::get('/wallet', 'UserController@wallet');
	Route::post('/addreview', 'UserController@addreview');
	

	Route::get('/email-verify', 'UserController@email_verify');
	Route::get('/resend-email', 'UserController@resend_email');
	Route::post('/email-verification', 'UserController@email_verification');
	Route::get('/forgot-password', 'UserController@forgot_password');
	Route::post('/forgot-password/forgot-password', 'UserController@forgotpassword');

	Route::get('category/', 'ProductController@category');
	Route::get('/products/{slug}', 'ProductController@products');
	Route::get('latest-products/', 'ProductController@latest');
	Route::get('explore-products/', 'ProductController@explore');
	Route::post('product/show', 'ProductController@show');
	Route::get('/product-details/{slug}', 'ProductController@productdetails');
	Route::post('/product/unfavorite', 'ProductController@unfavorite');
	Route::post('/product/favorite', 'ProductController@favorite');
	Route::get("/search","ProductController@search");

	Route::get('/favorite', 'FavoriteController@index');

	Route::get('/cart', 'CartController@index');
	Route::post('/cart/addtocart', 'CartController@addtocart');
	Route::post('/cart/delete', 'CartController@delete');
	Route::post('/cart/qtyupdate', 'CartController@qtyupdate');
	Route::post('/cart/applypromocode', 'CartController@applypromocode');
	Route::post('/cart/removepromocode', 'CartController@removepromocode');
	Route::post('/cart/checkoutdata', 'CartController@checkoutdata');
	Route::get('/cart/checkout', 'CartController@checkout');
	Route::get('/cart/list', 'CartController@list');

	Route::post('/orders/cashondelivery', 'OrderController@cashondelivery');
	Route::post('/orders/checkpincode', 'OrderController@checkpincode');
	Route::post('/orders/charge', 'OrderController@charge');
	Route::post('/orders/walletorder', 'OrderController@walletorder');
	Route::post('/orders/ordercancel', 'OrderController@ordercancel');
	Route::get('/orders', 'OrderController@index');
	Route::get('/order-details/{id}', 'OrderController@orderdetails');
	Route::get('/track-order/{id}', 'OrderController@track');
	// Get Route For Show Payment Form
	Route::get('/orders/paywithrazorpay', 'OrderController@payWithRazorpay')->name('paywithrazorpay');
	// Post Route For Makw Payment Request
	Route::post('/orders/payment', 'OrderController@payment')->name('payment');

	Route::get('/privacy', 'PrivacyPolicyController@privacy');
	Route::get('/about', 'AboutController@about');
	Route::get('/terms', 'TermsController@terms');
});

Route::get('privacy-policy', 'HomeController@policy');

Route::get('terms-condition', 'HomeController@terms');

Route::get('about-us', 'HomeController@aboutus');

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {

	Route::get('/auth', function () {
		return view('/auth');
	});

	Route::get('/', function () {
		return view('auth.login');
	});
	Route::group(['middleware' => ['AdminAuth']],function(){

		Route::get('home', 'AdminController@home');
		Route::post('changePassword', 'AdminController@changePassword');
		Route::post('settings', 'AdminController@settings');
		Route::get('getorder', 'AdminController@getorder');
		Route::get('clearnotification', 'AdminController@clearnotification');

		Route::get('slider', 'SliderController@index');
		Route::post('slider/store', 'SliderController@store');
		Route::get('slider/list', 'SliderController@list');
		Route::post('slider/show', 'SliderController@show');
		Route::post('slider/update', 'SliderController@update');
		Route::post('slider/destroy', 'SliderController@destroy');
		
		Route::get('category', 'CategoryController@index');
		Route::post('category/store', 'CategoryController@store');
		Route::get('category/list', 'CategoryController@list');
		Route::post('category/show', 'CategoryController@show');
		Route::post('category/update', 'CategoryController@update');
		Route::post('category/status', 'CategoryController@status');
		Route::post('category/delete', 'CategoryController@delete');

		Route::get('item', 'ItemController@index');
		Route::post('item/store', 'ItemController@store');
		Route::get('item/list', 'ItemController@list');
		Route::post('item/show', 'ItemController@show');
		Route::post('item/update', 'ItemController@update');
		Route::get('item-images/{id}', 'ItemController@itemimages');
		Route::post('item/showimage', 'ItemController@showimage');
		Route::post('item/updateimage', 'ItemController@updateimage');
		Route::get('item/itemimages', 'ItemController@itemimages');
		Route::post('item/storeimages', 'ItemController@storeimages');
		Route::post('item/storeingredientsimages', 'ItemController@storeingredientsimages');
		Route::post('item/delete', 'ItemController@delete');

		Route::get('contact', 'ContactController@index');

		Route::post('item/destroyimage', 'ItemController@destroyimage');
		Route::post('item/destroyingredients', 'ItemController@destroyingredients');
		Route::post('item/updateingredients', 'ItemController@updateingredients');
		Route::post('item/showingredients', 'ItemController@showingredients');
		Route::post('item/status', 'ItemController@status');

		Route::get('users', 'UserController@index');
		Route::post('users/store', 'UserController@store');
		Route::get('users/list', 'UserController@list');
		Route::post('users/show', 'UserController@show');
		Route::post('users/update', 'UserController@update');
		Route::post('users/status', 'UserController@status');
		Route::get('user-details/{id}', 'UserController@userdetails');

		Route::get('orders', 'OrderController@index');
		Route::get('orders/list', 'OrderController@list');
		Route::get('invoice/{id}', 'OrderController@invoice');
		Route::post('orders/destroy', 'OrderController@destroy');
		Route::post('orders/update', 'OrderController@update');
		Route::post('orders/assign', 'OrderController@assign');

		Route::get('reviews', 'RattingController@index');
		Route::get('reviews/list', 'RattingController@list');
		Route::post('reviews/destroy', 'RattingController@destroy');

		Route::get('payment', 'PaymentController@index');
		Route::post('payment/status', 'PaymentController@status');
		Route::get('manage-payment/{id}', 'PaymentController@managepayment');
		Route::post('payment/update', 'PaymentController@update');

		Route::get('promocode', 'PromocodeController@index');
		Route::post('promocode/store', 'PromocodeController@store');
		Route::get('promocode/list', 'PromocodeController@list');
		Route::post('promocode/show', 'PromocodeController@show');
		Route::post('promocode/update', 'PromocodeController@update');
		Route::post('promocode/status', 'PromocodeController@status');
		Route::post('promocode/delete', 'PromocodeController@delete');

		Route::get('pincode', 'PincodeController@index');
		Route::post('pincode/store', 'PincodeController@store');
		Route::get('pincode/list', 'PincodeController@list');
		Route::post('pincode/show', 'PincodeController@show');
		Route::post('pincode/update', 'PincodeController@update');
		Route::post('pincode/status', 'PincodeController@status');
		Route::post('pincode/delete', 'PincodeController@delete');

		Route::get('banner', 'BannerController@index');
		Route::post('banner/store', 'BannerController@store');
		Route::get('banner/list', 'BannerController@list');
		Route::post('banner/show', 'BannerController@show');
		Route::post('banner/update', 'BannerController@update');
		Route::post('banner/destroy', 'BannerController@destroy');

		Route::get('about', 'AboutController@index');
		Route::post('about/update', 'AboutController@update');

		Route::get('time', 'TimeController@index');
		Route::post('time/store', 'TimeController@store');
		Route::get('time/list', 'TimeController@list');
		Route::post('time/show', 'TimeController@show');
		Route::post('time/update', 'TimeController@update');
		Route::post('time/destroy', 'TimeController@destroy');

		Route::get('driver', 'DriverController@index');
		Route::post('driver/store', 'DriverController@store');
		Route::get('driver/list', 'DriverController@list');
		Route::post('driver/show', 'DriverController@show');
		Route::post('driver/update', 'DriverController@update');
		Route::post('driver/status', 'DriverController@status');
		Route::get('driver-details/{id}', 'DriverController@driverdetails');

		Route::get('privacypolicy', 'PrivacyPolicyController@index');
		Route::post('privacypolicy/update', 'PrivacyPolicyController@update');

		Route::get('termscondition', 'TermsController@index');
		Route::post('termscondition/update', 'TermsController@update');
		
	});
	
	Route::get('logout', 'AdminController@logout');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');