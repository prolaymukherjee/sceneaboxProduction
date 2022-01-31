<?php


// Route::get('/', function () {
//       echo "welcome to sceneabox";
//   });
Route::get('/', 'HomeController@index')->name('home');
Route::post('/search', 'HomeController@search')->name('search');
Route::post('/contents', 'HomeController@seeall')->name('contents');
Route::get('/content/{seeTitle}/{key}', 'HomeController@seeallfrontend');

Route::post('/signupsubmit', 'HomeController@signupSubmit')->name('signupsubmit');
Route::get('/login', 'HomeController@login')->name('login');
Route::post('/loginsubmit', 'HomeController@loginSubmit')->name('loginsubmit');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/forgotpass', 'HomeController@forgotPass')->name('forgotpass');

Route::get('/play/{contentid}', 'HomeController@play')->name('play');
Route::get('/testlogin/{contentid}', 'HomeController@play')->name('test');
Route::post('/postplaytime', 'HomeController@postPlayTime')->name('postplaytime');
Route::post('/postCampaignData', 'HomeController@postCampaignData')->name('postCampaignData');
Route::get('/subscription', 'HomeController@subscription')->name('subscription');
Route::get('/flix_myaccount', 'HomeController@flix_myaccount')->name('flix_myaccount');
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

Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
