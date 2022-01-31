<?php


// Route::get('/', function () {
//       echo "welcome to sceneabox";
//   });


Route::get('/', 'HomeController@index')->name('home');
Route::post('/search', 'HomeController@search')->name('search');
Route::post('/contents', 'HomeController@seeall')->name('contents');

Route::post('/signupsubmit', 'HomeController@signupSubmit')->name('signupsubmit');
Route::get('/login', 'HomeController@login')->name('login');
Route::post('/loginsubmit', 'HomeController@loginSubmit')->name('loginsubmit');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/forgotpass', 'HomeController@forgotPass')->name('forgotpass');

Route::get('/play/{contentid}', 'HomeController@play')->name('play');
Route::post('/postplaytime', 'HomeController@postPlayTime')->name('postplaytime');
Route::get('/subscription', 'HomeController@subscription')->name('subscription');

Route::post('/sub', 'HomeController@sub')->name('sub');
Route::get('/home/subcheck', 'HomeController@subcheck')->name('subcheck');
Route::post('/unsubNonSms', 'HomeController@unsubNonSms')->name('unsubNonSms');
Route::get('/home/unsub', 'HomeController@unsub')->name('unsub');


Route::get('/myaccount','HomeController@getAccountData');
Route::get('/about','HomeController@about');
Route::get('/help','HomeController@help');
Route::get('/privacy','HomeController@privacy');
Route::get('/license','HomeController@license');

Route::get('/{category}', 'HomeController@category')->name('category');
