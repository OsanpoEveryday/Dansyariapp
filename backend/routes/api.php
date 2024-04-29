<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WantController;
use App\Item;


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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/categories', 'CategoryController@index');
Route::post('/categories', 'CategoryController@store');
Route::get('/categories/{category}', 'CategoryController@show');
Route::put('/categories/{category}', 'CategoryController@update');
Route::delete('/categories/{category}', 'CategoryController@destroy');

// Route::get('/ownitems/category/{category}', 'ItemController@ownItems');
// Route::get('/wantitems/category/{category}', 'ItemController@wantItems');

// Route::get('/categories/disuse/{id}', 'ItemController@disuseItems');
// storeに対して基本的に認可は必要ない
// api.phpではAuthのミドルウェアを通さない設定になっている（web.phpに書く必要あり）
// Route::post('/wants', 'ItemController@store');

// Route Groupを使用
// Route::group(['middleware' => ['can:destroy,item']], function () {
//     Route::post('/user/profile', 'UserProfileController@show'); //この中に書くルーティング全てに同じミドルウェアが適用。２つ以上APIがある時に使える
// }
// Route::delete('/items/{item}', 'ItemController@destroy')
// ->middleware('can:userItem,item');



Route::get('/rules','RuleController@index');
// Route::get('/categoryedit/{categoryId}','RuleController@category');
Route::put('/categoryedit/rules/{rule}','RuleController@update');

Route::get('/home','ItemUsageHistoryController@items');

Route::post('/home','ItemUsageHistoryController@recordTime');
Route::post('/home/null','ItemUsageHistoryController@recordNull');
