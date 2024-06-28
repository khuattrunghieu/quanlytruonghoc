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

Route::group([
    'prefix' => '/student',
    'middleware' => [
        'checkLogin',
        'checkRole:1,view',
    ]
], function () {
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::post('/create', 'StudentController@store')->middleware('checkRole:1,add')->name('student.store');
    Route::get('/show/{id}', 'StudentController@show')->middleware('checkRole:1,edit')->name('student.show');
    Route::put('/update/{id}', 'StudentController@update')->middleware('checkRole:1,edit')->name('student.update');
    Route::delete('/destroy/{id}', 'StudentController@destroy')->middleware('checkRole:1,delete')->name('student.destroy');
});