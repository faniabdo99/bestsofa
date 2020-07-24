<?php
use Illuminate\Support\Facades\Route;
Route::get('/' , 'HomeController@getHome')->name('home');
//Not Logged In Routes
Route::middleware('guest')->group(function(){
  Route::get('signup' , 'UsersController@getSignup')->name('signup.get');
  Route::post('signup' , 'UsersController@postSignup')->name('signup.post');
  Route::get('login' , 'UsersController@getLogin')->name('login.get');
  Route::post('login' , 'UsersController@postLogin')->name('login.post');
  Route::get('social-login/{provider}' , 'UsersController@redirectToProvider')->name('login.social');
  Route::get('login/{driver}/callback' , 'UsersController@handleProviderCallback')->name('login.social.callback');
});
//Logged In Only Routes
Route::middleware('auth')->group(function(){
  Route::get('logout' , 'UsersController@logout')->name('logout');
});
//General Routes
Route::get('contact' , 'ContactUsController@getContact')->name('contact.get');
Route::post('contact' , 'ContactUsController@postContact')->name('contact.post');

//Admin Only Routes
Route::group(['prefix' => 'admin',  'middleware' => 'isAdmin'] , function () {
  Route::get('/' , 'AdminController@getHome')->name('admin.home');
  //System Settings
  Route::prefix('system')->group(function(){
    Route::get('/' , 'SystemSettingsController@getHome')->name('admin.system.home');
    Route::get('/edit/{id}' , 'SystemSettingsController@getEdit')->name('admin.system.getEdit');
    Route::post('/edit/{id}' , 'SystemSettingsController@postEdit')->name('admin.system.postEdit');
  });
  //Categories
  Route::prefix('categories')->group(function(){
    Route::get('/' , 'CategoriesController@getHome')->name('admin.categories.home');
    Route::get('/new' , 'CategoriesController@getNew')->name('admin.categories.getNew');
    Route::post('/new' , 'CategoriesController@postNew')->name('admin.categories.postNew');
    Route::get('/edit/{id}' , 'CategoriesController@getEdit')->name('admin.categories.getEdit');
    Route::post('/edit/{id}' , 'CategoriesController@postEdit')->name('admin.categories.postEdit');
    Route::get('/localize/{id}' , 'CategoriesController@getLocalize')->name('admin.categories.getLocalize');
  });
  //Products System
  Route::prefix('products')->group(function(){
    Route::get('/' , 'ProductsController@getHome')->name('admin.products.home');
    Route::get('/new' , 'ProductsController@getNew')->name('admin.products.getNew');
    Route::post('/new' , 'ProductsController@postNew')->name('admin.products.postNew');
    Route::get('/edit/{id}' , 'ProductsController@getEdit')->name('admin.products.getEdit');
    Route::post('/edit/{id}' , 'ProductsController@postEdit')->name('admin.products.postEdit');
    Route::get('/localize/{id}' , 'ProductsController@getLocalize')->name('admin.products.getLocalize');
  });
  //Users System
  Route::prefix('users')->group(function(){
    Route::get('/' , 'UsersController@getHome')->name('admin.users.home');
  });
});
