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

use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/stocks', 'AssetNameSymbolController@listAllStocksForBuying')->name('stocks');

Route::get('/listOfStocks', 'AssetNameSymbolController@listAllStocks');

Route::get('/listOfCryptos', 'AssetNameSymbolController@listAllCryptos');

Route::post('/stocks', function () {
    return view("/stocks");
})->name('stocks.price');

Route::get('/cryptos', 'AssetNameSymbolController@listAllCryptos');

Route::get('/price', 'DataFromYahooController@getPriceToday');

Route::post('/assetPrice', 'DataFromYahooController@getPriceToday');

Route::get('/pricesHistory', 'AssetNameSymbolController@listAllStocksForGraphics')->name('makeGraphics')->middleware('auth');

Route::get('/buyStocks', 'OperationController@create');

Route::post('/makeChart', 'DataFromYahooController@getDataForChart');

Route::post('/buyAsset', 'OperationController@store');

Route::post('/sellAsset', 'OperationController@sellAsset');

Route::get('/unsoldAssetList', 'OperationController@sellAssetList');

Route::get('/unsoldAssetList2', 'OperationController@sellAssetListSellingPrice');

Route::post('/getAccountValue', 'OperationController@getAccountValue');

Route::get('/user/id', 'UsersController@getUserId');

Route::get('/home/{any?}', function () {
    return view('home');
});

Route::get('/{any?}', function () {
    return view('welcome');
});
