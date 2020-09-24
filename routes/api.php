<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::post('login', function (Request $request) {return $request;});
Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::get('/countries', 'CountryController@Countries');
Route::post('/states', 'StateController@States');
Route::post('/lgas', 'LGAController@LGAs');
Route::get('/kleanaryitems', 'KleanaryItemController@kleanaryItems');
Route::get('/perfumes', 'PerfumeItemController@perfumeItems');
Route::get('/starchs', 'StarchItemController@starchItems');
//Route::get('/coupons', 'CouponController@Coupons');





Route::middleware('auth:api')->group(function() {
     Route::post('/auth', 'Api\UserController@auth');
    Route::post('/updateuser', 'Api\UserController@accountupdate');
    Route::post('/updatefav', 'Api\UserController@addfavorite');
     Route::post('/requestlaundry', 'Api\LaundryController@makerequest');
      Route::post('/give', 'Api\LaundryController@giveValue');
    Route::get('user/{userId}/detail', 'Api\UserController@show');
    Route::post('/logout', 'Api\UserController@logout');
    Route::post('/payment/callback', [
    'uses' => 'PaymentController@handleGatewayCallback'
]);

    Route::get('/requestpl', 'Api\LaundryController@RequestPLaundry');
    Route::get('/requestdl', 'Api\LaundryController@RequestDLaundry');
    Route::post('/laundrydetail', 'Api\LaundryController@viewlaundry');
    //facebook
  Route::get('/social/login/{driver}', 'Api\SocialLogin@redirectToProvider');
  Route::get('/social/callback/{driver}', 'Api\SocialLogin@handleProviderCallback');
  Route::post('/confirm-status', 'Api\LaundryController@confirmStatus');
    
});