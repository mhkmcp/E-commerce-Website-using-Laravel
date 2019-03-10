<?php

// -----------------FrontEnd Site--------------------
Route::get('/', 'HomeController@index');

// -----------------Category Wise Product--------------------
Route::get('/product_by_category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}', 'HomeController@show_product_by_manufacture');
Route::get('/view-product/{product_id}', 'HomeController@view_product_detail');
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{id}', 'CartController@delete_cart');
Route::get('/increment-cart/{id}', 'CartController@increment_cart');
Route::get('/decrement-cart/{id}', 'CartController@decrement_cart');

// -----------------Checkout Routes--------------------
Route::get('/login-check', 'CheckoutController@login_check');
Route::post('/customer-registration', 'CheckoutController@customer_registration');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-shipping', 'CheckoutController@save_shipping');

Route::get('/payment', 'CheckoutController@payment');
Route::post('/place-order', 'CheckoutController@place_order');


Route::get('/wishlist', 'WishlistController@show');
Route::post('/add-to-wishlist', 'WishlistController@add_to_wishlist');
Route::get('/delete-from-wishlist/{product_id}', 'WishlistController@delete_from_wishlist');


Route::get('/profile/{customer_id}', 'HomeController@profile');


// -----------------Login & Logout--------------------
Route::post('/customer-login', 'CheckoutController@customer_login');
Route::get('/customer-logout', 'CheckoutController@customer_logout');







// ------------------- BackEnd Site ------------------
// Route::get('logout', 'SuperAdminController@logout');
Route::get('/backend', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');


// ------------------- Category Related ------------------
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/inactive-category/{category_id}', 'CategoryController@inactive_category');
Route::get('/active-category/{category_id}', 'CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');



// ------------------- Manufacture Related ------------------
Route::get('/add-manufacture', 'ManufactureController@index');
Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
Route::get('/all-manufacture', 'ManufactureController@all_manufacture');
Route::get('/inactive-manufacture/{manufacture_id}', 'ManufactureController@inactive_manufacture');
Route::get('/active-manufacture/{manufacture_id}', 'ManufactureController@active_manufacture');

Route::get('/edit-manufacture/{manufacture_id}', 'ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{manufacture_id}', 'ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{manufacture_id}', 'ManufactureController@delete_manufacture');


// ------------------- Product Related ------------------
Route::get('/add-product', 'ProductController@index');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/inactive-product/{product_id}', 'ProductControler@inactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');


// ------------------- Slider Related ------------------
Route::get('/add-slider', 'SliderController@index');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/all-slider', 'SliderController@all_slider');

Route::get('/inactive-slider/{slider_id}', 'SliderController@inactive_slider');
Route::get('/active-slider/{slider_id}', 'SliderController@active_slider');
Route::get('/delete-slider/{slider_id}', 'SliderController@delete_slider');



// ------------------- Order Manage ------------------------
Route::get('/manage-order', 'ProductController@manage_order');


// ------------------- Customer Review ----------------------
Route::get('/review-product/{product_id}', 'ReviewController@review_product');
Route::post('/save-review/', 'ReviewController@save_review');
