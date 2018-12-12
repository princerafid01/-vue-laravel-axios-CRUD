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
    return view('index');
});
Route::post('/viewitems' , 'MainController@storeItem');
Route::get('/peoples' , 'MainController@index');
Route::get('/findPeople/{id}' , 'MainController@findItem');
Route::post('/updatePeople/{id}' , 'MainController@updateItem');
Route::get('/deletePeople/{id}' , 'MainController@deleteItem');
