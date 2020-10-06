<?php
use Illuminate\Support\Facades\Route;
Route::group(['scheme' => 'https'], function () {
Route::get('change-lang/{locale}', 'HomeController@changeLang')->name('changeLang');
Route::get('/' , 'HomeController@getHome')->name('home');
Route::get('/change-currency/{currency}/{currency_code}' , 'CurrencyController@setCurrency')->name('currency.change');
Route::get('/success' , 'OrdersController@orderSuccess')->name('order.success');
Route::get('privacy-policy' , 'PagesController@getPrivacyPolicy')->name('privacyPolicy');
Route::get('terms-and-conditions' , 'PagesController@getTOC')->name('toc');
//Not Logged In Routes
Route::middleware('guest')->group(function(){
  Route::get('signup' , 'UsersController@getSignup')->name('signup.get');
  Route::post('signup' , 'UsersController@postSignup')->name('signup.post');
  Route::get('login' , 'UsersController@getLogin')->name('login.get');
  Route::post('login' , 'UsersController@postLogin')->name('login.post');
  Route::get('reset-password' , 'UsersController@getResetPassword')->name('reset.get');
  Route::post('reset-password' , 'UsersController@postResetPassword')->name('reset.post');
  Route::get('change-password/{code}' , 'UsersController@resetFinalStep')->name('reset.finalStep');
  Route::post('change-password/{code}' , 'UsersController@postResetFinalStep')->name('reset.finalStep.post');
  Route::get('social-login/{provider}' , 'UsersController@redirectToProvider')->name('login.social');
  Route::get('login/{driver}/callback' , 'UsersController@handleProviderCallback')->name('login.social.callback');
});
//Logged In Only Routes
Route::middleware('auth')->group(function(){
  Route::get('logout' , 'UsersController@logout')->name('logout');
  Route::get('profile' , 'UsersController@getProfile')->name('profile');
  Route::get('wishlist' , 'UsersController@getWishlist')->name('wishlist');
  Route::get('my-orders' , 'UsersController@getOrdersList')->name('myOrders');
  Route::post('update-profile' , 'UsersController@updateProfile')->name('profile.update.post');
  Route::get('activate-account/{code}' , 'UsersController@activateAccount')->name('account.activate');
  Route::get('set-password/{id}' , 'UsersController@getSetPassword')->name('setPassword.get');
  Route::post('set-password/{id}' , 'UsersController@postSetPassword')->name('setPassword.post');
  Route::post('review' , 'ReviewsController@postReview')->name('review.post');
});
//General Routes
Route::get('contact' , 'ContactUsController@getContact')->name('contact.get');
Route::post('contact' , 'ContactUsController@postContact')->name('contact.post');
Route::get('about' , 'PagesController@getAboutUs')->name('about');
//Products Routes
Route::group(['prefix'=>'products'] , function (){
  Route::get('/{filter?}' , 'ProductsController@getAll')->name('product.home');
  Route::get('{id}/{slug}' , 'ProductsController@getSingle')->name('product.single');
});
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
    Route::get('/delete-gallery/{id}' , 'ProductsController@deleteGalleryImages')->name('admin.galleryImages.delete');
    Route::get('/localize/{id}' , 'ProductsController@getLocalize')->name('admin.products.getLocalize');
  });
  //Users System
  Route::prefix('users')->group(function(){
    Route::get('/' , 'UsersController@getHome')->name('admin.users.home');
  });
  //Discount System
  Route::prefix('discount')->group(function(){
    Route::get('/' , 'DiscountController@getHome')->name('admin.discount.home');
    Route::get('/new' , 'DiscountController@getNew')->name('admin.discount.getNew');
    Route::post('/new' , 'DiscountController@postNew')->name('admin.discount.postNew');
    Route::get('/edit/{id}' , 'DiscountController@getEdit')->name('admin.discount.getEdit');
    Route::post('/edit/{id}' , 'DiscountController@postEdit')->name('admin.discount.postEdit');
  });
  //Coupouns System
  Route::prefix('coupoun')->group(function(){
    Route::get('/' , 'CoupounsController@getHome')->name('admin.coupoun.home');
    Route::get('/new' , 'CoupounsController@getNew')->name('admin.coupoun.getNew');
    Route::post('/new' , 'CoupounsController@postNew')->name('admin.coupoun.postNew');
    Route::get('/edit/{id}' , 'CoupounsController@getEdit')->name('admin.coupoun.getEdit');
    Route::post('/edit/{id}' , 'CoupounsController@postEdit')->name('admin.coupoun.postEdit');
  });
  //Shipping Costs System
  Route::prefix('shipping-costs')->group(function(){
    Route::get('/' , 'ShippingCostsController@getHome')->name('admin.shippingCosts.home');
    Route::get('/new' , 'ShippingCostsController@getNew')->name('admin.shippingCosts.getNew');
    Route::post('/new' , 'ShippingCostsController@postNew')->name('admin.shippingCosts.postNew');
    Route::get('/edit/{id}' , 'ShippingCostsController@getEdit')->name('admin.shippingCosts.getEdit');
    Route::post('/edit/{id}' , 'ShippingCostsController@postEdit')->name('admin.shippingCosts.postEdit');
  });
    //Orders System
    Route::prefix('orders')->group(function(){
      Route::get('/' , 'OrdersController@getHome')->name('admin.orders.home');
      Route::get('/single/{id}' , 'OrdersController@getSingleOrder')->name('admin.orders.single');
      Route::post('/update-status/{id}' , 'OrdersController@updateOrderStatus')->name('admin.orders.updateStatus');
      Route::get('/new' , 'ProductsController@getNew')->name('admin.products.getNew');
      Route::post('/new' , 'ProductsController@postNew')->name('admin.products.postNew');
      Route::get('/edit/{id}' , 'ProductsController@getEdit')->name('admin.products.getEdit');
      Route::post('/edit/{id}' , 'ProductsController@postEdit')->name('admin.products.postEdit');
      Route::get('/localize/{id}' , 'ProductsController@getLocalize')->name('admin.products.getLocalize');
    });
    Route::prefix('invoice')->group(function(){
      Route::get('generate/{id}' , 'InvoiceController@generateInvoice')->name('invoice.generate.get');
      Route::post('update/{id}' , 'InvoiceController@postUpdate')->name('admin.invoice.update');
      Route::get('download/{id}' , 'InvoiceController@downloadInvoice')->name('invoice.download.get');
      Route::get('send-to-user/{id}' , 'InvoiceController@sendToUser')->name('invoice.sendToUser.get');
    });
});
//Cart Related Routes
Route::get('api/add-item-to-cart' ,'CartController@addItem')->name('cart.add');
Route::get('delete-from-cart/{cartId}/{userId}' ,'CartController@deleteItem')->name('cart.delete');
Route::get('cart' , 'CartController@getCartPage')->name('cart');
Route::get('checkout' , 'OrdersController@getCheckoutPage')->name('checkout');
Route::post('checkout', 'OrdersController@postOrder')->name('checkout.post');
Route::get('order-summary/{id}/{processed?}', 'OrdersController@getSummaryPage')->name('checkout.summary');
Route::get('order-payment/{id}', 'OrdersController@getPaymentPage')->name('checkout.payment');
Route::post('order-payment/{id}', 'OrdersController@postPaymentPage')->name('checkout.payment.post');
Route::post('apply-coupon' , 'CoupounsController@applyCoupon')->name('coupon.apply');
});
