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

Route::middleware('auth:api')->get('/student', function (Request $request) {
    return $request->user();
});

Route::middleware(['checkLogin', 'checkRole:1,view'])->group(function () {
    Route::get('/student', 'StudentController@index')->name('student.index');
    Route::post('/student/search', 'StudentController@search')->name('student.search');
    Route::post('/student/create', 'StudentController@store')->middleware('checkRole:1,add')->name('student.store');
    Route::get('/student/edit/{id}', 'StudentController@edit')->middleware('checkRole:1,edit')->name('student.edit');
    Route::put('/student/update/{id}', 'StudentController@update')->middleware('checkRole:1,edit')->name('student.update');
    Route::delete('/student/destroy/{id}', 'StudentController@destroy')->middleware('checkRole:1,delete')->name('student.destroy');
});