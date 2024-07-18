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

Route::prefix('api')->group(function(){
    Route::post('logout','Auth\LoginController@logout');
});

// web.phpはデフォルトでセッションによる認証を通るように設定されている（api.phpはされていない）
// ユーザーの認証が通っていなければ認可は通らない
// パラメータを使用するもの以外では認可が必要ないことが多い
Route::prefix('api')->group(function() {
    // Route::get('/ownitems/category/{category}', 'ItemController@ownItems')
    // ->middleware('can:userItem,category');

    Route::get('/getlinks', 'CategoryController@getLinks')
    ->middleware('auth');

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
    
    Route::post('/edititem/{item}', 'ItemController@update')
    ->middleware('can:userItem,item');

    Route::patch('/items/todisuse/{item}', 'ItemController@moveToDisuseItem');
    
    Route::patch('/items/toown/{item}', 'ItemController@moveToOwnItem');
    
});


Route::prefix('api')->group(function() {
    Route::get('/categories', 'CategoryController@index');
    // Route::get('/categoryedit/{categoryId}', 'CategoryController@show');
    Route::post('/categoryedit/{category}', 'CategoryController@update')
    ->middleware('can:userCategory,category');
    Route::post('/categories', 'CategoryController@store')
    ->middleware('auth');
    Route::delete('/deletecategory/{category}', 'CategoryController@destroy')
    ->middleware('can:userCategory,category');
});

Route::prefix('api')->group(function() {
    Route::post('/storerule/{category}','RuleController@store');
    Route::post('/editrule/{rule}','RuleController@update')
    ->middleware('can:userRule,rule');
    Route::post('/deleterule/{rule}','RuleController@destroy')
    ->middleware('can:userRule,rule');
});

Route::prefix('api')->group(function() {
    Route::get('/select/{category}','ItemUsageHistoryController@getAndSortItems')
    ->middleware('can:userCategory,category');
    Route::post('/select/recordtime','ItemUsageHistoryController@recordTime')
    ->middleware('auth');
    Route::post('/select/recordnull','ItemUsageHistoryController@recordNull')
    ->middleware('auth');
});


Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
