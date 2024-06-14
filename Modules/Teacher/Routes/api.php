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

Route::middleware('auth:api')->get('/teacher', function (Request $request) {
    return $request->user();
});

Route::middleware(['checkLogin', 'checkRole:2,view'])->group(function () {
    Route::get('/teacher', 'TeacherController@index')->name('teacher.index');
    Route::post('/teacher/search', 'TeacherController@search')->name('teacher.search');
    Route::post('/teacher/create', 'TeacherController@store')->middleware('checkRole:2,add')->name('teacher.store');
    Route::get('/teacher/edit/{$id}', 'TeacherController@edit')->middleware('checkRole:2,edit')->name('teacher.edit');
    Route::put('/teacher/update/{$id}', 'TeacherController@update')->middleware('checkRole:2,edit')->name('teacher.update');
    Route::delete('/teacher/destroy/{$id}', 'TeacherController@destroy')->middleware('checkRole:2,delete')->name('teacher.destroy');
});
