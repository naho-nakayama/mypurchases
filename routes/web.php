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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['prefix' => 'admin'], function() {
   
});

Route::get('/', 'BoughtforController@index');

Route::get('bought/bought_list', 'BoughtforController@bought_add')->middleware('auth');
Route::post('bought/bought_list', 'BoughtforController@bought_list')->middleware('auth');
Route::get('auth/register', 'BoughtforController@register_add');



Auth::routes();


Route::group(['prefix' => 'bought', 'middleware' => 'auth'], function() {
    Route::get('bought_list', 'Admin\Bought_itemController@bought_list_add')->middleware('auth');
    Route::post('bought_list', 'Admin\Bought_itemController@bought_list')->middleware('auth');
    Route::get('bought_create', 'Admin\Bought_itemController@bought_add')->middleware('auth');
    Route::post('bought_create', 'Admin\Bought_itemController@bought_create')->middleware('auth');
    Route::get('bought_list', 'Admin\Bought_itemController@index')->middleware('auth'); //キーワード検索のリスト表示と買ったものの実際のリスト表示のルーティング
    Route::get('bought_edit', 'Admin\Bought_itemController@edit')->middleware('auth');
    Route::post('bought_edit', 'Admin\Bought_itemController@update')->middleware('auth');
    Route::get('delete', 'Admin\Bought_itemController@delete')->middleware('auth');
    Route::get('bought_carender', 'Admin\Bought_carenderController@bought_carender_add')->middleware('auth'); //カレンダー表示のアクション
    
    Route::get('bought_carender', 'Admin\Bought_carenderController@bought_carender_add')->middleware('auth');
    Route::post('bought_carender', 'Admin\Bought_carenderController@bought_carender')->middleware('auth');
});

Route::group(['prefix' => 'want', 'middleware' => 'auth'], function() {
    Route::get('want_list', 'Admin\Want_itemController@index')->middleware('auth'); //キーワード検索のリスト表示と買いたいものの実際のリスト表示のルーティング
    Route::post('want_list', 'Admin\Want_itemController@want_list')->middleware('auth');
    Route::get('want_create', 'Admin\Want_itemController@want_add')->middleware('auth');
    Route::post('want_create', 'Admin\Want_itemController@want_create')->middleware('auth');
    
});

