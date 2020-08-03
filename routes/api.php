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
Route::post('activate-deactivate-user' , 'UsersController@ToggleActive')->name('admin.user.toggleActive');
Route::post('send-activate-link' , 'UsersController@sendActivateEmail')->name('user.sendActivateLink');