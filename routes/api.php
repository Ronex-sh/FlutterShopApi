<?php

use App\Http\Resources\UserFullResource;
use App\User;
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

// show product or tag or categories without auth user
//get categories
Route::get('categories','Api\CategoryController@index');
Route::get('categories/{id}','Api\CategoryController@show');
//get tag
Route::get('tags','Api\TagController@index');
Route::get('tags/{id}','Api\TagController@show');
//get products
Route::get('products','Api\ProductController@index');
Route::get('products/{id}','Api\ProductController@show');
//General Route
Route::get('countries','Api\CountryController@index');
Route::get('countries/{id}/states','Api\CountryController@showStates');
Route::get('countries/{id}/cities','Api\CountryController@showCities');

Route::get('users',function (){
  return UserFullResource::collection(User::paginate());
});


Route::group(['auth:api'],function (){});

//Route::middleware('auth:api')->get('/products', function (Request $request) {
//    return \App\Product::all();
//});
