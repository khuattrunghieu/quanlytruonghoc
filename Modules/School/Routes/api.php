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

Route::middleware('auth:api')->get('/school', function (Request $request) {
    return $request->user();
});

Route::middleware(['checkLogin', 'checkRole:4,view'])->group(function () {
    Route::get('/school', 'SchoolController@index')->name('school.index');
    Route::post('/school/search', 'SchoolController@search')->name('school.search');
    Route::post('/school/create', 'SchoolController@store')->middleware('checkRole:4,add')->name('school.store');
    Route::get('/school/edit/{id}', 'SchoolController@edit')->middleware('checkRole:4,edit')->name('school.edit');
    Route::put('/school/update/{id}', 'SchoolController@update')->middleware('checkRole:4,edit')->name('school.update');
    Route::delete('/school/destroy/{id}', 'SchoolController@destroy')->middleware('checkRole:4,delete')->name('school.destroy');
});