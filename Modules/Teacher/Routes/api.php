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

Route::group([
    'prefix' => '/teacher',
    'middleware' => [
        'checkLogin',
        'checkRole:2,view',
    ]
], function () {
    Route::get('/', 'TeacherController@index')->name('teacher.index');
    Route::post('/create', 'TeacherController@store')->middleware('checkRole:2,add')->name('teacher.store');
    Route::get('/show/{id}', 'TeacherController@show')->middleware('checkRole:2,edit')->name('teacher.show');
    Route::put('/update/{id}', 'TeacherController@update')->middleware('checkRole:2,edit')->name('teacher.update');
    Route::delete('/destroy/{id}', 'TeacherController@destroy')->middleware('checkRole:2,delete')->name('teacher.destroy');
});
