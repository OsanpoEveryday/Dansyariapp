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
Auth::routes();

// web.phpはデフォルトでセッションによる認証を通るように設定されている（api.phpはされていない）
// ユーザーの認証が通っていなければ認可は通らない
// パラメータを使用するもの以外では認可が必要ないことが多い
Route::prefix('api')->group(function() {
    // Route::get('/ownitems/category/{category}', 'ItemController@ownItems')
    // ->middleware('can:userItem,category');

    Route::get('/ownitems/category/{category}', 'ItemController@ownItems')
    ->middleware('can:userCategory,category');

    Route::get('/disuseitems/category/{category}', 'ItemController@disuseItems')
    ->middleware('can:userCategory,category');

    Route::get('/wantitems/category/{category}', 'ItemController@wantItems')
    ->middleware('can:userCategory,category');

    Route::delete('/items/{item}', 'ItemController@destroy')
    // can以下はAuthServiceProviderのGateの第一引数と一致
    ->middleware('can:deleteItem,item');

    Route::post('/storewantitem/{category}', 'ItemController@storeWantItem')
    ->middleware('auth');

    Route::post('/storeownitem/{category}', 'ItemController@storeOwnItem')
    ->middleware('auth');

    Route::post('/storedisuseitem/{category}', 'ItemController@storeDisuseItem')
    ->middleware('auth');
    
    Route::post('/edititem/{item}', 'ItemController@update');
    
});


Route::prefix('api')->group(function() {
    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@store');
});

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
