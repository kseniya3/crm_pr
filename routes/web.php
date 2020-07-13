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

<<<<<<< HEAD
Route::get('/home/clients', 'ClientController@index')->name('home');
=======
Route::get('/deal', 'DealController@index')->name('deal');
>>>>>>> 5e77a89be5d5daaf9b210801bdb9c403062f73a5
