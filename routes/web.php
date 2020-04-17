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
Route::get('/createpage',[
    'uses'=>'pagesController@getcreatepage',
    'as'=>'create-page',
    'middleware'=>'auth'
]);
Route::get('/page/{page_id}',[
    'uses'=>'pagesController@getpage',
    'as'=>'page',
    'middleware'=>'auth'
]);
Route::post('/createpage',[
    'uses'=> 'pagesController@createpage',
    'as'=> 'page.create',
    'middleware'=> 'auth'
]);
Route::post('/pagepost',[
    'uses'=> 'pagespostController@postpagepost',
    'as'=> 'page.post',
    'middleware'=> 'auth'
]);
Route::get('/image/{image_name}',[
    'uses'=> 'pagespostController@Getfile',
    'as'=> 'image',
    'middleware'=> 'auth'
]);
Route::get('/post/{post_id}',[
    'uses'=> 'pagespostController@getpost',
    'as'=> 'post',
    'middleware'=> 'auth'
]);
Route::post('/card',[
    'uses'=> 'pagespostController@card',
    'as'=> 'card',
    'middleware'=> 'auth'
]);
Route::get('/otp',[
    'uses'=> 'pagesController@getotp',
    'as'=> 'otp',
    'middleware'=> 'auth'
]);
Route::post('/pay',[
    'uses'=> 'pagespostController@postotp',
    'as'=> 'pay',
    'middleware'=> 'auth'
]);