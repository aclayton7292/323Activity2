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
    return view('home');
});

Route::get('/login', function(){
   return view('login'); 
});

Route::get('/hello', function(){
    return "hello world";
});
Route::get('/test2','TestController@test2');

Route::get('/askme', function(){
     return view('whoami');
});
Route::get('/login2', function(){
    return view('login2');
});
Route::get('/login3', function(){
    return view('login3');
});
Route::get('/calc', function(){
    return view('CalculatorView');
});
Route::get('/login5', function(){
    return view('login3');
});
Route::post('/doFunction','CalculatorController@index');

Route::post('/whoami','WhatsMyNameController@index');
Route::post('/dologin','LoginController@index');
Route::post('/dologin2','Login2Controller@index');
Route::post('/dologin3','Login5Controller@index');
Route::post('/dologin4','Login4Controller@index');




