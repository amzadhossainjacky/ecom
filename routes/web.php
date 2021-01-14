<?php

//Route::get('/', function () {});

Route::get('/', 'FrontendController@index');

//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');
Route::get('/user/view/order/{id}', 'HomeController@viewOrder')->name('user.view.order');
Route::post('/user/order/tracking', 'FrontendController@show')->name('user.track.order');
Route::post('/product/search', 'FrontendController@searchProduct')->name('product.search');

//admin=======
Route::get('admin/home', 'AdminController@index')->name('admin.home');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');

// Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');


//admin routing for ecommerce
//categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@storecategory')->name('store.category');
Route::get('admin/delete/category/{id}', 'Admin\Category\CategoryController@deletecategory')->name('delete.category');
Route::get('admin/edit/category/{id}', 'Admin\Category\CategoryController@editcategory')->name('edit.category');
Route::post('admin/update/category/{id}', 'Admin\Category\CategoryController@updatecategory')->name('update.category');

//brand
Route::get('admin/brands', 'Admin\Brand\BrandController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Brand\BrandController@storebrand')->name('store.brand');
Route::get('admin/delete/brand/{id}', 'Admin\Brand\BrandController@deletebrand')->name('delete.brand');
Route::get('admin/edit/brand/{id}', 'Admin\Brand\BrandController@editbrand')->name('edit.brand');
Route::post('admin/update/brand/{id}', 'Admin\Brand\BrandController@updatebrand')->name('update.brand');

//subcategories
Route::get('admin/sub/category', 'Admin\SubCategory\SubCategoryController@subCategory')->name('sub.categories');
Route::post('admin/store/sub/category', 'Admin\SubCategory\SubCategoryController@storeSubCategory')->name('store.subCategory');
Route::get('admin/delete/sub/category/{id}', 'Admin\SubCategory\SubCategoryController@deleteSubCategory')->name('delete.subcategory');
Route::get('admin/edit/sub/category/{id}', 'Admin\SubCategory\SubCategoryController@editSubCategory')->name('edit.subcategory');
Route::post('admin/update/sub/category/{id}', 'Admin\SubCategory\SubCategoryController@updateSubCategory')->name('update.subcategory');

//coupons-----
Route::get('admin/coupons', 'Admin\Coupon\CouponController@coupon')->name('coupons');
Route::post('admin/store/coupon', 'Admin\Coupon\CouponController@storeCoupon')->name('store.coupon');
Route::get('admin/delete/coupon/{id}', 'Admin\Coupon\CouponController@deleteCoupon')->name('delete.coupon');
Route::get('admin/edit/coupon/{id}', 'Admin\Coupon\CouponController@editCoupon')->name('edit.coupon');
Route::post('admin/update/coupon/{id}', 'Admin\Coupon\CouponController@updateCoupon')->name('update.coupon');

//newsletters-----
Route::get('admin/newsletters', 'Admin\Newsletter\NewsletterController@newsletter')->name('newsletter');
Route::get('admin/delete/newsletter/{id}', 'Admin\Newsletter\NewsletterController@deleteNewsletter')->name('delete.newsletter');

//frontend routes---
Route::post('admin/newsletter', 'Admin\FrontEndController@storeNewsletter')->name('store.newsletter');


//product route--
Route::get('admin/product/all', 'Admin\Product\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\Product\ProductController@create')->name('add.product');
Route::post('admin/product/store', 'Admin\Product\ProductController@store')->name('store.product');
Route::get('admin/active/product/{id}', 'Admin\Product\ProductController@activeProduct')->name('active.product');
Route::get('admin/inactive/product/{id}', 'Admin\Product\ProductController@inactiveProduct')->name('inactive.product');
Route::get('admin/delete/product/{id}', 'Admin\Product\ProductController@deleteProduct')->name('delete.product');
Route::get('admin/view/product/{id}', 'Admin\Product\ProductController@viewProduct')->name('view.product');
Route::get('admin/edit/product/{id}', 'Admin\Product\ProductController@editProduct')->name('edit.product');
Route::post('admin/update/product/{id}', 'Admin\Product\ProductController@updateProductWithoutImage')->name('update.product.withoutimage');
Route::post('admin/update/productImage/{id}', 'Admin\Product\ProductController@updateProductImage')->name('update.product.image');

//wishlist
Route::get('add/wishlist/{id}', 'WishlistController@addWishlist')->name('addWishlist');

//ajax sub category(product)--
Route::get('get/subcategory/{category_id}', 'Admin\Product\ProductController@getSubcategory');

//add to cart 
Route::post('add/to/cart', 'CartController@addCart')->name('addCart');
Route::get('check', 'CartController@check')->name('check');
Route::get('products/cart', 'CartController@showCart')->name('show.cart');
Route::get('product/remove/{rowId}','CartController@removeCart')->name('remove.cart');
Route::post('product/update/{rowId}','CartController@updateCart')->name('update.cart');
Route::get('user/wishlists','CartController@showWishlists')->name('user.wishlist');
Route::get('user/checkout','CartController@checkout')->name('user.checkout');
Route::post('coupon/apply','CartController@couponApply')->name('apply.coupon');
Route::get('remove/coupon','CartController@couponRemove')->name('remove.coupon');

//payment 
Route::get('user/payment/process','PaymentController@payment')->name('payment.step');
Route::post('user/payment','PaymentController@paymentType')->name('paymentType');
Route::post('user/payment/stripe','PaymentController@paymentStripe')->name('stripe.charge');

//orders
Route::get('admin/pending/orders','Admin\Order\OrderController@newOrder')->name('new.pending.orders');
Route::get('admin/view/orders/{id}','Admin\Order\OrderController@viewOrder')->name('view.order');
Route::get('admin/accept/orders/{id}','Admin\Order\OrderController@acceptOrder')->name('admin.accept.order');
Route::get('admin/cancel/orders/{id}','Admin\Order\OrderController@cancelOrder')->name('admin.cancel.order');
Route::get('admin/accept/all/orders','Admin\Order\OrderController@acceptAllOrder')->name('admin.accept.all.orders');
Route::get('admin/cancel/all/orders','Admin\Order\OrderController@cancelAllOrder')->name('admin.cancel.all.orders');
Route::get('admin/progress/all/orders','Admin\Order\OrderController@progressAllOrder')->name('admin.progress.all.orders');
Route::get('admin/delivery/all/orders','Admin\Order\OrderController@successAllOrder')->name('admin.success.all.orders');
Route::get('admin/delivery/orders/{id}','Admin\Order\OrderController@deliveryProgress')->name('admin.delivery.order');
Route::get('admin/success/orders/{id}','Admin\Order\OrderController@successOrder')->name('admin.success.order');

//return order list (users)
Route::get('/user/return/order/list','HomeController@returnOrderLists')->name('return.order.list');
Route::get('/user/return/order/{id}','HomeController@returnOrder')->name('user.return.order');
//return order list (admin)
Route::get('/admin/return/order/list','Admin\ReturnOrder\ReturnOrderController@returnOrders')->name('admin.return.order');
Route::get('/admin/return/order/approve/{id}','Admin\ReturnOrder\ReturnOrderController@approveReturn')->name('admin.approve.return');
Route::get('/admin/view/all/return/order','Admin\ReturnOrder\ReturnOrderController@viewAllReturn')->name('admin.view.return.order');

//site setting 
Route::get('admin/site/setting','Admin\SiteSetting\SiteSetting@siteSetting')->name('admin.site_setting');
Route::post('admin/update/site/setting','Admin\SiteSetting\SiteSetting@updateSetting')->name('update.admin.sitesetting');


//product details
Route::get('product/details/{id}/{product_title}', 'ProductDetailsController@productView')->name('product.detail');
//Route::post('cart/product/add/{id}', 'ProductDetailsController@addToCart'); //not ajax use and come from product details page

//index ajax modal product view route
Route::get('cart/product/view/{id}', 'ProductDetailsController@cartProductView');
Route::post('cart/product/add/{id}', 'ProductDetailsController@addToCart')->name('add.product.cart');
Route::get('products/view/{id}', 'ProductDetailsController@viewAllProducts')->name('viewAllProducts');


//user profile with mail verification

