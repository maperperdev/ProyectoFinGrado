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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UsersController@getLoggedUser');

Route::get('/stocks', 'AssetNameSymbolController@listAllStocksForBuying')->name('stocks');

Route::post('/stocks', function () {
    return view("/stocks");
})->name('stocks.price');

Route::get('/cryptos', 'AssetNameSymbolController@listAllCryptos');

Route::get('/price', 'DataFromYahooController@getPriceToday');

Route::post('/stocksData', 'DataFromYahooController@getPriceToday');

Route::get('/pricesHistory', 'AssetNameSymbolController@listAllStocksForGraphics')->name('makeGraphics')->middleware('auth');

Route::get('/buyStocks', 'OperationController@create');

Route::post('/makeChart', 'DataFromYahooController@getDataForChart');

Route::post('/buyStocks', 'OperationController@store');
