<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

//Route::get('/home/clients', 'ClientController@index')->name('client-add-form');
Route::get('/home/clients', function(){
    return view('client_temp');
})->name('client-add-form');
/* Route::post('/home/clients', function(){
    return "Okey";
}); */
Route::post('/home/clients', 'ClientController@create')->name('client-add-form');
Route::get('/deal', 'DealController@index')->name('deal');
