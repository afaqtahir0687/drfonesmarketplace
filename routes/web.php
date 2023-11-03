<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\BuyerLoginController;
use App\Http\Controllers\Auth\SellerLoginController;

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

Route::group(['prefix'=>'seller','as'=>'seller.'], function(){
    Route::get('/login', function(){
        return view('frontend.auth.seller_login');
    });
    Route::post('/login', [SellerLoginController::class, 'index']);
    Route::get('/logout', [SellerLoginController::class, 'logout']);
});

Route::group(['prefix'=>'buyer','as'=>'buyer.'], function(){
    Route::get('/login', function(){
        return view('frontend.auth.buyer_login');
    });

    Route::get('/registration', function(){
        return view('frontend.auth.buyer_registration');
    });
    Route::post('/login', [BuyerLoginController::class, 'authenticate']);
    Route::post('/registration', [BuyerLoginController::class, 'registration']);
});

Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['prefix'=>'devices','as'=>'devices.'], function(){
    Route::any('/unposted', [DeviceController::class, 'get_unposted_devices']);
    Route::get('/posted', [DeviceController::class, 'get_posted_devices']);
    Route::post('/published', [DeviceController::class, 'published']);
    Route::view('/publish/all','frontend.devices.publish_all');
    Route::post('/publish', function(Request $request){
        $serial = $request->serial;
        return view('frontend.devices.publish_all', get_defined_vars());
    });
    Route::post('/publish/all',[DeviceController::class, 'publish_all']);
    Route::post('/publish/all/devices', [DeviceController::class, 'publish_device_all']);
    Route::get('/publish/{serial}', [DeviceController::class, 'publish_device']);
    Route::get('/edit-price/{serial}', [DeviceController::class, 'edit_price']);
    Route::post('/edit-price', [DeviceController::class, 'editPrice']);
});

Route::post('mark-sold',[App\Http\Controllers\SearchController::class, 'mark_sold']);
Route::post('mark-sold/all',[App\Http\Controllers\SearchController::class, 'mark_sold_all']);

Route::view('/free-demo' , 'frontend.free-demo');
Route::post('/submit-demo-requestion', [App\Http\Controllers\HomeController::class, 'freeDemo']);
Route::view('/contact-us','frontend.contact-us');

Route::resource('review', App\Http\Controllers\CommentsController::class);
Route::get('/delete-review/{id}', [App\Http\Controllers\CommentsController::class, 'destroy']);
Route::get('/get-review-detail', [App\Http\Controllers\CommentsController::class, 'getReview']);

Route::get('/imei-search',[SearchController::class, 'search_imei']);
Route::view('/testimonials' , 'frontend.testimonials');
// Route::post('/testimonials', [App\Http\Controllers\HomeController::class, 'testimonials']);

Route::view('/news' , 'frontend.news');
Route::post('/submit-demo-requestion', [App\Http\Controllers\HomeController::class, 'news']);
Route::view('/news','frontend.news');
Route::post('/send-booking-email', [App\Http\Controllers\HomeController::class, 'sendBookingEmail']);



Route::post('/subscribe', [App\Http\Controllers\HomeController::class, 'subscribe']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('q/{model}', [App\Http\Controllers\HomeController::class, 'search']);
Route::get('{slug}', [App\Http\Controllers\HomeController::class, 'view']);
