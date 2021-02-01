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
Route::get('/registerUser', function(){
        return view('showRegister');
});
Route::get('/login5', function(){
    return view('login3');
});



Route::get('/logout','LoginController@logoutUser');
Route::post('/dologin3','LoginController@index');
Route::post('/doRegister','LoginController@createUser');
Route::get('/showUsers','LoginController@showAllUsers');






