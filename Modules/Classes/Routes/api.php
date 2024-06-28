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

Route::group([
    'prefix' => '/class',
    'middleware' => [
        'checkLogin',
        'checkRole:3,view',
    ]
], function () {
    Route::get('/', 'ClassesController@index')->name('class.index');
    Route::post('/create', 'ClassesController@store')->middleware('checkRole:3,add')->name('class.store');
    Route::get('/show/{id}', 'ClassesController@show')->middleware('checkRole:3,edit')->name('class.show');
    Route::put('/update/{id}', 'ClassesController@update')->middleware('checkRole:3,edit')->name('class.update');
    Route::delete('/destroy/{id}', 'ClassesController@destroy')->middleware('checkRole:3,delete')->name('class.destroy');
});