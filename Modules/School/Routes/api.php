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

Route::group([
    'prefix' => '/school',
    'middleware' => [
        'checkLogin',
        'checkRole:4,view',
    ]
], function () {
    Route::get('/', 'SchoolController@index')->name('school.index');
    Route::post('/create', 'SchoolController@store')->middleware('checkRole:4,add')->name('school.store');
    Route::get('/show/{id}', 'SchoolController@show')->middleware('checkRole:4,edit')->name('school.show');
    Route::put('/update/{id}', 'SchoolController@update')->middleware('checkRole:4,edit')->name('school.update');
    Route::delete('/destroy/{id}', 'SchoolController@destroy')->middleware('checkRole:4,delete')->name('school.destroy');
});