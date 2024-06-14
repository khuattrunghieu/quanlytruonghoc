<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/classes', function (Request $request) {
    return $request->user();
});
Route::middleware(['checkLogin', 'checkRole:3,view'])->group(function () {
    Route::get('/class', 'ClassesController@index')->name('class.index');
    Route::post('/class/search', 'ClassesController@search')->name('class.search');
    Route::post('/class/create', 'ClassesController@store')->middleware('checkRole:3,add')->name('class.store');
    Route::get('/class/edit/{$id}', 'ClassesController@edit')->middleware('checkRole:3,edit')->name('class.edit');
    Route::put('/class/update/{$id}', 'ClassesController@update')->middleware('checkRole:3,edit')->name('class.update');
    Route::delete('/class/destroy/{$id}', 'ClassesController@destroy')->middleware('checkRole:3,delete')->name('class.destroy');
});