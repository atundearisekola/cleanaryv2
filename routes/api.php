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
Route::post('/add-country', 'CountryController@addCountry');
//Route::post('/delete-country', 'CountryController@deleteCountry');
Route::get('/countries', 'CountryController@Countries');


Route::post('/add-state', 'StateController@addState');
Route::post('/states', 'StateController@States');
Route::post('/update-state', 'StateController@updateState');
Route::post('/delete-state', 'StateController@deleteState');

Route::post('/add-lga', 'LGAController@addLGA');
Route::post('/lgas', 'LGAController@LGAs');
Route::post('/update-lga', 'LGAController@updateLGA');
Route::post('/delete-lga', 'LGAController@deleteLGA');



Route::post('/add-item', 'KleanaryItemController@addItem');
Route::get('/kleanaryitems', 'KleanaryItemController@kleanaryItems');
Route::post('/update-item', 'KleanaryItemController@updateItem');
Route::post('/delete-items', 'KleanaryItemController@deleteItem');

Route::post('/add-perfume', 'PerfumeController@addItem');
Route::get('/perfumes', 'PerfumeItemController@perfumeItems');
Route::post('/update-perfume', 'PerfumeController@updateItem');
Route::post('/delete-perfume', 'PerfumeController@deleteItem');


Route::post('/add-starch', 'StarchController@addItem');
Route::get('/starchs', 'StarchItemController@starchItems');
Route::post('/update-starch', 'StarchController@updateItem');
Route::post('/delete-starch', 'StarchController@deleteItem');




Route::middleware('auth:api')->group(function() {
     Route::post('/auth', 'Api\UserController@auth');
    Route::post('/updateuser', 'Api\UserController@accountupdate');
    Route::post('/updatefav', 'Api\UserController@addfavorite');
     Route::post('/requestlaundry', 'Api\LaundryController@makerequest');
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