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
});