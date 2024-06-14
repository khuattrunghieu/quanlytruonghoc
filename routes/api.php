<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('welcome');
})->middleware('checkLogin');

Route::post('login', 'AuthController@storeLogin')->name('login');
Route::post('register', 'AuthController@storeRegister')->name('register');
Route::post('send-otp', 'AuthController@sendOtp')->name('send.otp');
Route::post('check-otp', 'AuthController@checkOtp')->name('check.otp');
Route::post('change-password', 'AuthController@changePassword')->name('change.password');

Route::middleware(['checkLogin'])->group(function () {
    Route::get('account', 'InternalController@account')->name('account');
    Route::get('category', 'InternalController@category')->name('category');
    Route::post('update-role/{id}', 'InternalController@updateRole')->middleware('checkRole:1,edit,2,edit')->name('update.role');
});







