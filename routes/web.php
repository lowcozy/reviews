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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/register', 'Sentinel\RegisterController@register')->name('register');
Route::post('/register', 'Sentinel\RegisterController@postRegister')->name('postRegister');
Route::get('/login', 'Sentinel\LoginController@login')->name('login');
Route::post('/login', 'Sentinel\LoginController@postLogin')->name('postLogin');
Route::get('/logout', 'Sentinel\LoginController@logout')->name('logout');

//ADMIN 
Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'admin']], function()
{
   	 Route::get('dashboard', ['as'=>'admin.dashboard','uses'=>'AdminController@dashboard']);

   	 // place routes
   	 Route::group(['prefix' => 'place'], function()
   	 {
   	 	Route::get('create',['as'=>'admin.place.create','uses'=>'PlaceController@create']);
   	 });

      // category routes
    Route::group(['prefix' => 'category'], function()
    {
         Route::get('create',['as'=>'admin.category.create','uses'=>'CategoryController@create']);
         Route::post('create',['as'=>'admin.category.create','uses'=>'CategoryController@save']);
         Route::get('index',['as'=>'admin.category.index','uses'=>'CategoryController@index']);
         Route::get('table',['as'=>'admin.category.table','uses'=>'CategoryController@table']);
    });

      //user Route
   	 Route::group(['prefix' => 'user'], function()
   	 {
         Route::get('add',['as'=>'admin.user.add','uses'=>'Admin\UserController@add']);
   	 	   Route::get('list',['as'=>'admin.user.list','uses'=>'Admin\UserController@index']);
         Route::post('delete',['as'=>'admin.user.delete','uses'=>'Admin\UserController@delete']);
         Route::get('edit/{id}',['as'=>'admin.user.edit','uses'=>'Admin\UserController@edit']);
         Route::post('update/{id}',['as'=>'admin.user.update','uses'=>'Admin\UserController@update']);
         Route::get('search',['as'=>'admin.user.search','uses'=>'Admin\UserController@search']);
   	 });
});


//User
Route::group(['prefix' => 'user'], function()
{
   Route::post('/loginAjax', 'Sentinel\LoginController@loginAjax')->name('loginAjax');
   Route::post('/registerAjax', 'Sentinel\RegisterController@registerAjax')->name('registerAjax');
   Route::get('/listing','User\UserController@listing')->name('user.listing');
   Route::get('/profile/{id}','User\UserController@profile')->name('user.profile');
   Route::get('/edit/{id}','User\UserController@edit')->name('user.edit');
});

//Listing cua? User
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function()
{
    Route::get('addListing',['as'=>'user.addListing','uses'=>'User\ListingController@add']);
    Route::post('storeListing',['as'=>'user.storeListing','uses'=>'User\ListingController@store']);
    Route::get('/listing/{id}','User\UserController@listing')->name('user.listing');
    Route::get('/edit/{id}','User\UserController@edit')->name('user.edit');
    Route::post('/update/{id}','User\UserController@update')->name('user.update');
});



// Ajax
Route::group(['prefix' => 'ajax'], function()
{
    Route::post('getDistrict',['as'=>'getDistrict','uses'=>'AjaxController@showDistrict']);
    Route::get('checkLoginAjax',['as'=>'checkLoginAjax','uses'=>'AjaxController@checkLogin']);
    Route::post('addReview',['as'=>'addReview','uses'=>'AjaxController@addReview']);
    Route::post('loadMore',['as'=>'loadMore','uses'=>'AjaxController@loadMore']);
});

// danh sach các địa điểm
Route::get('list-listing', 'User\ListingController@list')->name('list-listing');
Route::get('search',['as'=>'listing.search','uses'=>'User\ListingController@search']);
Route::get('listing/{id}',['as'=>'listing.detail','uses'=>'User\ListingController@detail']);
