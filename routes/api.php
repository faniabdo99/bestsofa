<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//*********Admin API Routes
//Categories
Route::post('delete-category' , 'CategoriesController@delete')->name('admin.category.delete');
Route::post('/category/localize' , 'CategoriesController@postLocalize')->name('admin.categories.postLocalize');
//Products
Route::post('delete-product' , 'ProductsController@delete')->name('admin.product.delete');
Route::post('upload-images' , 'ProductsController@uploadGalleryImages')->name('admin.product.uploadGalleryImages');
Route::post('/product/localize' , 'ProductsController@postLocalize')->name('admin.products.postLocalize');
//Users
Route::post('delete-user' , 'UsersController@delete')->name('admin.user.delete');
//Discount
Route::post('delete-discount' , 'DiscountController@delete')->name('admin.discount.delete');
Route::post('activate-deactivate-user' , 'UsersController@ToggleActive')->name('admin.user.toggleActive');
//Coupon
Route::post('delete-coupon' , 'CoupounsController@delete')->name('admin.coupoun.delete');
//Shipping Costs
Route::post('delete-shipping-cost' , 'ShippingCostsController@delete')->name('admin.shippingCosts.delete');
Route::post('calculate-shipping-cost' , 'ShippingCostsController@calculateShippingCost')->name('admin.shippingCosts.calculate');
//Cart
Route::post('update-cart' , 'CartController@postUpdate')->name('cart.update');
//Order VAT Number
Route::post('update-order-vat/{id}' , 'OrdersController@updateVatNumber')->name('order.updateVat');
//*********non-Admin API Routes
Route::post('send-activate-link' , 'UsersController@sendActivateEmail')->name('user.sendActivateLink');
Route::post('ask-question-about-product' , 'ProductsController@askQuestion')->name('product.askQuestion');
Route::post('like-item' , 'FavouriteController@ToggleFavourite')->name('favourite.toggle');
