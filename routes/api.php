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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    Route::post('/login', 'ApiAuthController@login');
    Route::get('/news', 'ApiBeritaController@news');
    Route::get('/allpengaduan', 'ApiPengaduanController@allpengaduan');
    Route::get('/pengaduanbyuser', 'ApiPengaduanController@pengaduanbyuser');
    Route::get('/addpengaduan', 'ApiPengaduanController@addpengaduan');
    Route::post('/storepengaduan', 'ApiAuthController@storepengaduan');
});
