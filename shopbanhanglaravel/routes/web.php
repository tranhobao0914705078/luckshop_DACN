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

//frontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');
Route::post('/autocomplete-search', 'App\Http\Controllers\HomeController@autocomplete_search');
Route::get('/trang-chu/{product_id}', 'App\Http\Controllers\ProductController@details_product');
Route::post('/insert-rating', 'App\Http\Controllers\ProductController@insert_rating');

//Customer
Route::get('/view-profile/{customer_id}', 'App\Http\Controllers\CustomerController@view_profile');
Route::get('/change-pass-cus/{customer_id}', 'App\Http\Controllers\CustomerController@change_pass_cus');
Route::get('/update-profile/{customer_id}', 'App\Http\Controllers\CustomerController@update_profile');
Route::post('/update-profile-user/{customer_id}', 'App\Http\Controllers\CustomerController@update_profile_user');
Route::post('/change-password-user/{customer_id}', 'App\Http\Controllers\CustomerController@change_password_user');

//contact
Route::get('/contact', 'App\Http\Controllers\ContactController@contact');
Route::get('/information', 'App\Http\Controllers\ContactController@information');
Route::post('/save-info', 'App\Http\Controllers\ContactController@save_info');
Route::post('/update-info/{info_id}','App\Http\Controllers\ContactController@update_info');



// danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@details_product');
Route::get('/tag/{product_tag}', 'App\Http\Controllers\ProductController@tag');
Route::post('/load-comment', 'App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment', 'App\Http\Controllers\ProductController@send_comment');


//backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/profile', 'App\Http\Controllers\AdminController@profile');
Route::get('/change-pass', 'App\Http\Controllers\AdminController@change_pass');

//category product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

//brand product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product')->middleware('auth.roles');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product')->middleware('auth.roles');

Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');

//product

Route::group(['middleware' => 'auth.roles'], function(){
    Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
    Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
});

Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');

Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product')->middleware('auth.roles');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product')->middleware('auth.roles');

Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');

//cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::post('/update-cart-quantity', 'App\Http\Controllers\CartController@update_cart_quantity');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::get('/del-product/{session_id}', 'App\Http\Controllers\CartController@delete_product');
Route::get('/del-all-product', 'App\Http\Controllers\CartController@delete_all_product');

//coupon
Route::post('/check-coupon', 'App\Http\Controllers\CartController@check_coupon');

//coupon-Admin
Route::get('/insert-coupon', 'App\Http\Controllers\CouponController@insert_coupon');
Route::get('/list-coupon', 'App\Http\Controllers\CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}', 'App\Http\Controllers\CouponController@delete_coupon');
Route::post('/insert-coupon-code', 'App\Http\Controllers\CouponController@insert_coupon_code');

//checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::post('/confirm-order', 'App\Http\Controllers\CheckoutController@confirm_order');

//Order-Admin
Route::get('/manage-order', 'App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{order_code}', 'App\Http\Controllers\OrderController@view_order');
Route::get('/print-order/{checkout_code}', 'App\Http\Controllers\OrderController@print_order');
Route::get('/history', 'App\Http\Controllers\OrderController@history');
Route::get('/view-history-order/{order_code}', 'App\Http\Controllers\OrderController@view_history_order');
Route::post('/update-order-qty', 'App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty', 'App\Http\Controllers\OrderController@update_qty');
Route::post('/cancel-order', 'App\Http\Controllers\OrderController@cancel_order');

//Send mail
Route::get('/send-mail', 'App\Http\Controllers\MailController@send_mail');
Route::get('/forgetPassword', 'App\Http\Controllers\MailController@forgetPassword');
Route::post('/recover-pass', 'App\Http\Controllers\MailController@recover_pass');
Route::get('/update-new-pass', 'App\Http\Controllers\MailController@update_new_pass');
Route::post('/reset-new-pass', 'App\Http\Controllers\MailController@reset_new_pass');


//Banner
Route::get('/manage-slider', 'App\Http\Controllers\SliderController@manage_slider');
Route::get('/add-slider', 'App\Http\Controllers\SliderController@add_slider');
Route::get('/unactive-slide/{slider_id}', 'App\Http\Controllers\SliderController@unactive_slide');
Route::get('/active-slide/{slider_id}', 'App\Http\Controllers\SliderController@active_slide');
Route::get('/delete-slide/{slider_id}', 'App\Http\Controllers\SliderController@delete_slide');
Route::post('/insert-slider', 'App\Http\Controllers\SliderController@insert_slider');


//Authentication-Roles
Route::get('/register-auth', 'App\Http\Controllers\AuthController@register_auth');
Route::get('/login-auth', 'App\Http\Controllers\AuthController@login_auth');
Route::get('/logout-auth', 'App\Http\Controllers\AuthController@logout_auth');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

//Authentication-Roles_user
Route::get('/users', 'App\Http\Controllers\UserController@index')->middleware('auth.roles');
Route::get('/delete-user-roles/{admin_id}', 'App\Http\Controllers\UserController@delete_user_roles')->middleware('auth.roles');
Route::get('/all-role', 'App\Http\Controllers\RoleController@all_role')->middleware('auth.roles');
Route::post('/assign-roles', 'App\Http\Controllers\UserController@assign_roles');
Route::post('/add-role', 'App\Http\Controllers\RoleController@add_role')->middleware('auth.roles');
Route::get('/delete-roles/{id_roles}', 'App\Http\Controllers\RoleController@delete_roles')->middleware('auth.roles');

//Gallery
Route::get('/add-gallery/{product_id}', 'App\Http\Controllers\GalleryController@add_gallery')->middleware('auth.roles');
Route::post('/select-gallery', 'App\Http\Controllers\GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}', 'App\Http\Controllers\GalleryController@insert_gallery');
Route::post('/update-gallery-name', 'App\Http\Controllers\GalleryController@update_gallery_name');
Route::post('/delete-gallery', 'App\Http\Controllers\GalleryController@delete_gallery');

//Chart
Route::post('/filter-by-date', 'App\Http\Controllers\AdminController@filter_by_date');
Route::post('/dashboard-filter', 'App\Http\Controllers\AdminController@dashboard_filter');
Route::post('/days-order', 'App\Http\Controllers\AdminController@days_order');
