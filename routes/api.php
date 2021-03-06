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
    Route::get('/profil', 'ApiUserController@profil');
    Route::get('/news', 'ApiBeritaController@news');
    Route::get('/allpengaduan', 'ApiPengaduanController@allpengaduan');
    Route::get('/pengaduanbyuser', 'ApiPengaduanController@pengaduanbyuser');
    Route::get('/getlayanan', 'ApiPengaduanController@addpengaduan');
    Route::get('/getsurvey', 'ApiSurveyController@surveyindividu');
    Route::post('/addpengaduan', 'ApiPengaduanController@storepengaduan');
});
