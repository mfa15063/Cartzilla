<?php

use App\Models\Offer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\WishListController;
use App\Http\Controllers\Users\ProductReviewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\CheckoutController;
use App\Http\Controllers\Users\OrderController;
use App\Http\Controllers\Users\UserController;

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
use Illuminate\Http\Request;
// Email Verfication Routes
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
});
    Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/email/verify', function () {
    dd("welcome");
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Backckend Controllers
Route::group(['namespace' => 'Backend','prefix' => 'adminpanel','middleware' => ['auth','verified','admin']], function() {
    // Stripe routes

    // main routes
    Route::get('/', 'HomeController@dashboard');
    Route::resource('/users', 'UserController');
    Route::post('changePriceCategory', 'UserController@change_category');
    Route::resource('categories', 'CategoryController');
    Route::resource('brands', 'BrandController');
    Route::resource('products', 'ProductController');
    Route::resource('products.images', 'ProductImageController');
    Route::resource('offers', 'OfferController');

    //Order Controllers
    Route::resource('orders', 'OrderController');
    Route::get('order/invoice/{id}' , "OrderController@invoice")->name('order.invoice');
    Route::post('changeOrderStatus', 'OrderController@change_status');

    Route::get('user-profile', 'ProfileController@user_profile');
    Route::post('settings/upload/image', 'SettingController@upload_image');
    Route::post('user-profile', 'ProfileController@user_profile_update');

    Route::get('change-password', 'ProfileController@change_password');
    Route::post('change-password', 'ProfileController@change_password_submit');

    Route::get('settings', 'SettingController@website_settings');
    Route::put('settings', 'SettingController@website_settings_update');




});

Route::group(['namespace' => 'Auth'], function() {
// Routes for Login via Third Party Service
Route::get('/google-auth', 'AuthenticatedSessionController@redirectToProvider');
Route::get('/callback', 'AuthenticatedSessionController@handleProviderCallback');
Route::get('/fb-auth', 'AuthenticatedSessionController@redirectToFB');
Route::get('/callback/fb', 'AuthenticatedSessionController@handleProviderCallbackFB');
});



Route::middleware(['auth','verified'])->group(function () {
    Route::get('add-to-wishlist/{id}' , [WishListController::class , 'add'])->name('add-to-wish');
    Route::get('wishlist' , [WishlistController::class , 'index'])->name('user.wishlist');
    Route::get('orders' , [OrderController::class , 'orders'])->name('user.orders');
    Route::get('wishlist/remove/{id}' , [WishlistController::class , 'remove'])->name('user.wishlist.remove');
    Route::get('order/detail/{id}' , [OrderController::class , 'order_detail'])->name('user.order.detail');
    Route::view('profile' , 'user.profile')->name('user.profile');
    Route::post('profile/update' , [UserController::class , 'update'])->name('user.profile.update');
    Route::view('change-password' , 'user.change-password')->name('user.change-password');
    Route::get('/search-state', 'SearchController@search_state');
    Route::get('/search-city/{id}', 'SearchController@search_city');
    Route::post('/add-review/{id}', [ReviewController::class , 'add'])->name('add-review');
    Route::post('/add-review', [ProductReviewsController::class , 'add'])->name('add-review');

    Route::get('/checkout', [HomeController::class , 'checkout'])->name('front.checkout');
    Route::post('checkout' , [CheckoutController::class , 'checkout'])->name('user.checkout');
    Route::get('thankyou', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');
    Route::get('cancel-transaction', [CheckoutController::class, 'cancelTransaction'])->name('checkout.cancel');
});

Route::get('/', 'HomeController@index')->name('front.index');
Route::get('/privacy-policy', 'HomeController@privacy_policy')->name('front.privacy-policy');
Route::get('/terms-and-condition', 'HomeController@terms')->name('front.terms');
Route::get('/returns-policy', 'HomeController@returns_policy')->name('front.returns');
Route::get('/add-to-cart/{product_id}/{offer?}/{quantity?}/{color?}', [HomeController::class , 'add_to_cart'])->name('add-to-cart');
Route::get('/shop/{all?}', 'HomeController@all')->name('front.products');
Route::get('/filter', 'HomeController@filter')->name('front.products.filter');
Route::get('/product/{slug}', 'HomeController@product')->name('front.product');
Route::get('/cart', [HomeController::class , 'cart'])->name('front.cart');
Route::get('/remove/{id}', [HomeController::class , 'remove'])->name('front.product.remove');
Route::get('/remove/{id}/{quantity?}', [HomeController::class , 'change_quantity'])->name('front.cart.change-quantity');
Route::get('/search/{search?}/{cat?}', [HomeController::class , 'search'])->name('front.products.search');
Route::get('/getcities/{id?}', [HomeController::class , 'getCities'])->name('front.state.cities');
Route::get('/product/{id}/details', 'HomeController@quickView')->name('quick-view');
Route::get('/offers', function(){
    return view('frontend.offers')->with('offers' , Offer::paginate(9));
})->name('front.offers');

require __DIR__.'/auth.php';
