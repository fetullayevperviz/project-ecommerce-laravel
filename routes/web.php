<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
    //return view('welcome');
//});

//frontend route start
Route::match(['get','post'],'/','IndexController@index');
Route::get('/products/{id}','ProductsController@products');
Route::get('/categories/{category_id}/{url}','IndexController@categories');
Route::get('/get-product-price','ProductsController@getPrice');
//Route for login or register
Route::get("/login-register","UsersController@userLoginRegister");
//Route for add user registration
Route::post("/user-register","UsersController@userRegister");
//Route for user login
Route::post("/user-login","UsersController@userLogin");
//Route for user logout
Route::get("/user-logout","UsersController@userLogout");
//Route for add to cart
Route::match(['get','post'],'/add-cart','ProductsController@addToCart');
//Route cart
Route::match(['get','post'],'/cart','ProductsController@cart');
//Route for delete cart Product
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');
//Route for update cart quantity
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');
//Apply coupon code
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');
//Route for middleware after front login
Route::group(["middleware"=>["frontlogin"]],function(){
    //Route for user accaunt
    Route::match(["get","post"],"/user-account","UsersController@userAccount");
    //Route for change password
    Route::match(["get","post"],"/change-password","UsersController@changePassword");
    //Route for address
    Route::match(["get","post"],"/change-address","UsersController@changeAddress");
    //Route for checkout
    Route::match(["get","post"],"/checkout","ProductsController@checkout");
    //Route for order review
    Route::match(["get","post"],"/order-review","ProductsController@orderReview");
    //Route for place order
    Route::match(["get","post"],"/place-order","ProductsController@placeOrder");
    //Route for thanks
    Route::get("/thanks","ProductsController@thanks");
    //Route for orders
    Route::get("/orders","ProductsController@userOrders");
    //Route for user orders
    Route::get("/orders/{id}","ProductsController@userOrderDetails");
});
//frontend route end


//backend route start
//Route admin login
Route::match(['get','post'],'/admin','AdminController@login');
//Route admin auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']],function(){
   Route::get('/admin/dashboard','AdminController@dashboard');
   //Category Route
   Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
   Route::match(['get','post'],'/admin/view-categories','CategoryController@viewCategories');
   Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
   Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
   Route::post('/admin/update-category-status','CategoryController@updateStatus');
   //Product Route
   Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
   Route::match(['get','post'],'/admin/view-products','ProductsController@viewProducts');
   Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
   Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProduct');
   Route::post('/admin/update-product-status','ProductsController@updateStatus');
   Route::post('/admin/update-featured-product-status','ProductsController@updateFeaturedStatus');
   //Product Attributes
   Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
   Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');
   Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');
   Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');
   Route::get('/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');
   //Banners Route
   Route::match(['get','post'],'/admin/banners','BannersController@banners');
   Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
   Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
   Route::match(['get','post'],'/admin/delete-banner/{id}','BannersController@deleteBanner');
   Route::post('/admin/update-banner-status','BannersController@updateStatus');
   //Coupons Route
   Route::match(['get','post'],'/admin/add-coupon','CouponController@addCoupon');
   Route::match(['get','post'],'/admin/view-coupons','CouponController@viewCoupons');
   Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponController@editCoupon');
   Route::get('/admin/delete-coupon/{id}','CouponController@deleteCoupon');
   Route::post('/admin/update-coupon-status','CouponController@updateStatus');
});
Route::get('/logout','AdminController@logout');
//backend route end