<?php


Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/login', function () {
    return view('auth.login');
})->name('login.index');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::resource('users', 'UserController');
    Route::resource('news', 'BeritaController');

});

Route::get('/', function () {
    return redirect('/home');
});
