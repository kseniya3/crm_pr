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





Route::group(['prefix'=>'/deals','as'=>'deals.'],function(){
    Route::get('/', 'DealController@index')->name('index');
    Route::get('/create', 'DealController@create')->name('create');
    Route::post('/store', 'DealController@store')->name('store');
}); 
//Route::get('/home/clients', 'ClientController@index')->name('client-add-form');

// Route::get('/home/clients', 'ClientController@index')->name('client-add-form');
Route::group(['prefix' => '/clients','as'=>'clients.'], function () {
    Route::post('/create', 'ClientController@create')->name('create_client');
    Route::get('/show', 'ClientController@Show')->name('show_clients');
    Route::get('/delete/{id}','ClientController@Del')->name('delete_client');
    Route::get('/update/{id}', 'ClientController@updateClientStr')->name('update_client_str');
    Route::post('/update/{id}','ClientController@updateClient')->name('update_client');

    
});
Route::get('/home/clients', function(){
    return view('Client\client_temp');
})->name('client-add-form');


Route::get('/deal', 'DealController@index')->name('deal');
