<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/', 'MainController@home');
Route::get('search','MainController@search');
Route::get('/autocomplete', array('as' => 'autocomplete', 'uses'=>'MainController@autocomplete'));

Route::get('/site-search', function () {return view('pages.site-search');});
Route::get('/privacy', function () {return view('pages.privacy');});
Route::get('/terms-of-use', function () {return view('pages.terms-of-use');});
Route::get('/contact-us', function () {return view('pages.contact');});
Route::get('/states', 'MainController@states');
Route::get('/uk-counties', 'MainController@ukcounties');
Route::get('/uk-counties/{slug}', 'MainController@ukcounties1');
Route::get('/uk-schools/{slug}', 'MainController@ukschools1');
Route::get('/uk-schools', 'MainController@ukschools');
Route::get('/districts', 'MainController@districts');
Route::get('/blocks', 'MainController@blocks');
Route::get('/schools-in-india', 'MainController@schools');
Route::get('/states/{slug}', 'MainController@states1');
Route::get('/districts/{slug}', 'MainController@districts1');
Route::get('/cities/{slug}', 'MainController@cities1');
Route::get('/pincodes/{slug}', 'MainController@pincodes1');
Route::get('/blocks/{slug}', 'MainController@blocks1');
Route::get('/schools-in-india/{slug}', 'MainController@schools1');
Route::get('/usa-states', 'MainController@usastates');
Route::get('/usa-states/{slug}', 'MainController@usastates1');
Route::get('/usa-counties', 'MainController@usacounties');
Route::get('/usa-counties/{slug}', 'MainController@usacounties1');
Route::get('/usa-schools/{slug}', 'MainController@usaschools1');
Route::get('/usa-schools', 'MainController@usaschools');
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('route:clear');
      Artisan::call('view:clear');
    return "Cache is cleared";
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});