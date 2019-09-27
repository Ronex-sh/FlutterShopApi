<?php

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

use App\City;
use App\Http\Controllers\StateController;
use App\Image;
use App\Product;
use App\Role;
use App\State;
use App\Tag;
use App\User;


//Route::get('units','DataImportController@importUnits');


// Route::get('cities', function () {
//     return City::with(['country','state'])->paginate(4) ;
// });
// Route::get('countries', function () {
//     return Country::with(['cities','states'])->paginate(4) ;
// });
// Route::get('states', function () {
//     return State::with(['cities','country'])->paginate(4) ;
// });

// Route::get('users', function () {
//     return User::paginate(100) ;
// });
// Route::get('images', function () {
//     return Image::paginate(100) ;
// });
// Route::get('product', function () {
//     return Product::with('images') -> paginate(100) ;
// });



// Route::get('test', function () {
//     return 'helo' ;
// })->middleware('auth','email_verified');
// ////////////////
// Route::get('tag', function () {
//     $tag=Tag::find(2);
//     return $tag->products;
// });
// Route::get('product-tag', function () {
//     $product=Product::find(1);
//     return $product->tags;
// });
// ////////////////
// Route::get('user-role', function () {
//     $user=User::find(501);
//     return $user->roles;
// });
// Route::get('role', function () {
//     $role=Role::find(2);
//     return $role->users;
// });

// Route::get('test_user', function () {
//     return 'helo' ;
// })->middleware('auth','user_is_admin');

// Route::get('test_user_s', function () {
//     return 'helo' ;
// })->middleware('auth','user_is_support');



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


    Route::group(['auth','user_is_support'], function () {
   //units
    Route::get('units','UnitController@index')->name('units');
    Route::post('units','UnitController@store');
    Route::delete('units','UnitController@delete');
    Route::put('units','UnitController@update');
    Route::get('search-units','UnitController@search')->name('search-units');

   //categories
    Route::get('categories','CategoryController@index')->name('categories');
    Route::post('categories','CategoryController@store');
    Route::get('search-categories','CategoryController@search')->name('search-categories');
    Route::delete('categories','CategoryController@delete');
    Route::put('categories','CategoryController@update');


    //products
    Route::get('products','ProductController@index')->name('products');

    Route::get('new-product','ProductController@newProduct')->name('new-product');
    Route::get('update-product/{id}','ProductController@newProduct')->name('update-product');

    Route::put('update-product','ProductController@update')->name('update-product');
    Route::post('new-product','ProductController@store');

    Route::delete('new-product/{id}','ProductController@delete');

    //tags
    Route::get('tags','TagController@index')->name('tags');
    Route::post('tags','TagController@store');
    Route::get('search-tags','TagController@search')->name('search-tags');
    Route::delete('tags','TagController@delete');
    Route::put('tags','TagController@update');

    //countries
    Route::get('countries','CountryController@index')->name('countries'); //name( الاسم المختصر الي يعبر عن هذا الراوت الي ممكن استخدامه في اي مكان مثل app.blade.php)
    //cities
    Route::get('cities','CityController@index')->name('cities');
    //states
    Route::get('states','StateController@index')->name('states');
    //reviews
    Route::get('reviews','ReviewController@index')->name('reviews');
    //tickets
    Route::get('tickets','TicketController@index')->name('tickets');
    //Roles
    Route::get('roles','RoleController@index')->name('roles');
});



