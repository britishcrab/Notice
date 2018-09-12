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

Route::get('/', 'ArrivalNoticeController@index');
Route::get('home', 'ArrivalNoticeController@getHome');

//送信テスト用
Route::get('test', 'NoticeController@test');
Route::get('yahoo', 'YahooController@getYahooTv')->name('get.yahoo.tv');
Route::post('yahoo', 'YahooController@postYahooTv')->name('post.yahoo.tv');

// make:authで作成されたルート
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
