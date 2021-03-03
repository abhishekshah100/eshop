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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('testing','ProductController@test');

Route::get('send-mail', 'CustomerController@new_mail');

Route::get('fizzybuzz', 'SearchController@fizzybuzz');
Route::get('palindrome', 'SearchController@palindrome');
Route::post('palindrome', 'SearchController@postpalindrome')->name('post-palindrome');



// Google login start here
Route::get('login/google', 'CustomerController@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'CustomerController@handleGoogleCallback');
// Google Login end here
/*  Front End Routing Start Here */

Route::get('/','FrontendShowProductController@homepage')->name('home');

Route::get('all-product','FrontendShowProductController@allproduct')->name('all-product');

Route::get('all-product/{condition}','FrontendShowProductController@allconditionproduct');

Route::get('category/{slug}','FrontendShowProductController@categoryproduct');

Route::get('product-detail/{slug}','FrontendShowProductController@productdetail')->name('product-detail');

Route::get('getdeliveryinformation','PincodeController@getdeliveryinformation')->name('get-delivery-information');

Route::get('search','FrontendShowProductController@search');

Route::view('about','frontend.pages.about-us')->name('about');

Route::view('contact','frontend.pages.contact')->name('contact');

Route::view('register','frontend.pages.register');

Route::post('register-now','CustomerController@register');

Route::post('newsletter','CustomerController@newsletter')->name('newsletter');

Route::view('login','frontend.pages.login')->name('login');

Route::get('verify/{email}/{code}','CustomerController@verify');

Route::get('changepassword/{email}/{code}','CustomerController@changepassword');

Route::post('updatepassword','CustomerController@updatepassword')->name('updatepassword');

Route::view('forgot-password','frontend.pages.forgot_password')->name('forgot-password');

Route::post('forgot-password','CustomerController@forgot_password');

Route::post('login','CustomerController@login')->name('login-user');

Route::get('logout','CustomerController@logout')->name('logout-user');

Route::get('my-account','UserPanelController@index')->name('my-account')->middleware('UserAuth');

Route::post('my-account','UserPanelController@saveaccountdetail')->name('save-account')->middleware('UserAuth');

Route::get('wishlist','FrontendShowProductController@wishlistpage')->name('wishlist')->middleware('UserAuth');

Route::get('wishlistTrashButton','FrontendShowProductController@wishlisttrashbutton')->middleware('UserAuth');

Route::get('movetobagbutton','FrontendShowProductController@movetobagbutton')->middleware('UserAuth');

Route::post('updateuseraddress','CustomerController@updateuseraddress')->name('update-user-address')->middleware('UserAuth');

Route::get('cart','FrontendShowProductController@addtocartpage')->name('cart');

Route::get('remove-cart','FrontendShowProductController@removecart');

Route::get('/addtocartproduct','FrontendShowProductController@addtocartproduct');

Route::get('/quickviewproduct','FrontendShowProductController@quickviewproduct');

Route::get('/quantity-cart','FrontendShowProductController@updatequantity');

Route::get('showmodalincart','FrontendShowProductController@showmodalincart');

Route::get('checkout','FrontendShowProductController@checkout')->name('checkout')->middleware('UserAuth');

Route::post('checkout','FrontendShowProductController@checkoutpost');

Route::get('ajax-wishlist','FrontendShowProductController@ajaxwishlist');

Route::get('offcanvascart','FrontendShowProductController@offcanvascart');

Route::get('offcanvaswishlist','FrontendShowProductController@offcanvaswishlist');

Route::get('gettotalquantity','FrontendShowProductController@gettotalquantity');

Route::get('gettotalwishlist','FrontendShowProductController@gettotalwishlist');

Route::get('gettotalamount','FrontendShowProductController@gettotalamount');

Route::post('contact','ContactController@store')->name('store-contact');

Route::get('saveuseraddress','CustomerController@saveuseraddress')->middleware('UserAuth');

Route::get('check-coupon','FrontendShowProductController@checkcoupon')->middleware('UserAuth');

/*  Front End Routing End Here */


/********************************************************************/
/*  Administrator Routing Start Here */

Route::view('admin/login','admin.pages.login')->name('admin-login');

Route::post('admin/login','AuthController@login')->name('login-auth');

Route::get('admin/logout','AuthController@logout')->name('admin-logout');


/********* If admin session is available *********/
Route::group(['prefix' =>'admin','middleware' =>['AdminAuth']],function(){

Route::view('dashboard','admin.pages.dashboard')->name('dashboard');

Route::get('order','OrderController@index')->name('view-order');

Route::get('contact','ContactController@showadmin');

Route::get('deletecontact/{contact}','ContactController@destroy')->name('admin-delete-contact');

Route::get('invoice/{order_id}','OrderController@showinvoice')->name('order-invoice');

Route::get('generatepdfinvoice/{order_id}','OrderController@generatepdfinvoice')->name('generate-pdf-order-invoice');

Route::get('customer','CustomerController@viewcustomer')->name('view-customer');

Route::get('customer/status/{user}','CustomerController@changestatus')->name('customer.status');

Route::get('categorydata','ProductController@categorydata')->name('category-data');

Route::get('testing','ProductController@test');

Route::get('branddata','ProductController@branddata')->name('brand-data');

Route::put('add_stock/{id}','ProductController@addstock');

Route::get('homeui','WebsiteuiController@frontendhomeui')->name('frontend-home-ui');

Route::get('deletehomeslider/{homeslider}','WebsiteuiController@homesliderdestroy')->name('admin-delete-homeslider');

Route::post('addslider','WebsiteuiController@homeuiaddslider');

Route::get('pincode','PincodeController@index')->name('pincode');

Route::get('pincode/status/{pincode}','PincodeController@changestatus')->name('pincode.status');

Route::get('pincodeapi','PincodeController@checkpincodeapi')->name('pincode-api');

Route::post('add-pincode','PincodeController@store')->name('add-pincode');

Route::patch('pincode/{pincode}','PincodeController@update')->name('update-pincode');

Route::delete('pincode/{pincode}','PincodeController@destroy')->name('delete-pincode');

Route::get('coupon','CouponController@index')->name('coupon');

Route::post('add-coupon','CouponController@store')->name('add-coupon');

Route::patch('coupon/{coupon}','CouponController@update')->name('update-coupon');

Route::delete('coupon/{coupon}','CouponController@destroy')->name('delete-coupon');

Route::get('coupon/status/{coupon}','CouponController@changestatus')->name('coupon.status');

Route::post('editslider/{id}','WebsiteuiController@homeuieditslider');

Route::post('editpremiumproduct/{id}','WebsiteuiController@homeuieditpremium');

Route::post('editcategoryproduct','WebsiteuiController@homeuieditcategoryproduct');

Route::post('editofferbanners/{id}','WebsiteuiController@homeuieditofferbanners');

/******  Check This route***********/
Route::post('sliderimages','WebsiteuiController@adminsliderimages')->name('admin-slider-images');
/******  Check This route***********/

Route::resource('category','CategoryController');

Route::resource('sub_category','SubCategoryController');

Route::get('sub-category/status/{subCategory}','SubCategoryController@changestatus')->name('sub_category.status');

Route::get('category/status/{category}','CategoryController@changestatus')->name('category.status');

Route::resource('brand','BrandsController');

Route::get('brand/status/{brand}','BrandsController@changestatus')->name('brand.status');

Route::resource('product','ProductController');

Route::get('product/status/{product}','ProductController@changestatus')->name('product.status');

Route::get('hot-deal','ProductController@hotdeal')->name('admin-hot-deal');

Route::get('/viewhotdeal','ProductController@viewhotdeal')->name('admin-view-hot-deal');

Route::get('/viewproductstock/{id}','ProductController@viewproductstock')->name('admin-view-product-stock');

Route::get('/getproductdetail','ProductController@getproductdetail');

Route::post('/addhotdeal','ProductController@addhotdeal')->name('add-hot-deal');

Route::post('/edithotdeal','ProductController@edithotdeal')->name('edit-hot-deal');

Route::get('/removehotdealproduct','ProductController@removehotdealproduct');

Route::get('website-settings','WebsiteuiController@showurl')->name('show-url');

Route::post('website-settings','WebsiteuiController@updatewebsitesettings')->name('update-website-settings');

Route::get('other-settings','EcommerceSettingController@othersettings')->name('other-settings');

Route::post('other-settings','EcommerceSettingController@updateothersettings')->name('update-other-settings');

Route::get('newsletter','NewsletterController@adminindex')->name('admin-newsletter');

Route::get('deletenewsletter/{newsletter}','NewsletterController@destroy')->name('admin-delete-newsletter');

Route::get('request-vendor','VendorController@requestvendor')->name('request-vendor');

Route::get('approve-vendor/{id}','VendorController@approvevendor')->name('approve-vendor');

Route::get('view-vendor','VendorController@viewvendor')->name('view-vendor');

Route::get('add-vendor','VendorController@adminaddvendor')->name('admin-add-vendor');

Route::post('add-vendor','VendorController@adminaddpostvendor')->name('admin-post-add-vendor');

});

/*  Admin Routing End Here */

/*  Vendor Routing Start Here */
Route::get('vndor/register','VendorAuthController@register')->name('vendor-register');

Route::post('vndor/register','VendorAuthController@postregister')->name('vendor-register-post');

Route::get('vendor/login','VendorAuthController@login')->name('vendor-login');

Route::group(['prefix' =>'vendor','middleware' =>['VendorAuth']],function(){

Route::get('company-details','VendorAuthController@companydetails')->name('vendor-company');

Route::post('company-details','VendorAuthController@postcompanydetails')->name('vendor-add-company');

Route::get('request-product','VendorController@requestproduct')->name('vendor-request-product');

Route::get('request-product','VendorController@requestproduct')->name('vendor-request-product');

});
/*  Vendor Routing End Here */
