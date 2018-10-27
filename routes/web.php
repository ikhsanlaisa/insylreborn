<?php


Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/login', function () {
    return view('auth.login');
})->name('login.index');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//    Route::resource('user/siswa', 'UserController');
    Route::resource('news', 'BeritaController');
    Route::resource('user/admin', 'AdminController');
    Route::resource('cabor', 'OlahragaController');
    Route::resource('kelas', 'KelasController');
    Route::resource('kontak', 'KontakController');
    Route::resource('jadwal', 'JadwalController');
    Route::resource('result', 'PertandinganController');

    Route::group(['prefix' => 'user'], function () {
        Route::resource('siswa', 'SiswaController');
        Route::get('listkelas', 'JadwalController@create')->name('jadwal.list');
    });

    Route::group(['prefix' => 'user/profile'], function () {
        Route::get('/{username}', 'ProfileController@index')->name('profile');
        Route::get('/{username}/change_password', 'ProfileController@editPassword')->name('edit-password');
        Route::put('/edit/{user}', 'ProfileController@updateProfile')->name('update.profile');
        Route::put('/change_password/{user}', 'ProfileController@updatePassword')->name('update.password');
    });

    Route::put('updatedatakelas/{id}', 'KelasController@update');
    Route::put('updatedatacabor/{id}', 'OlahragaController@update');
    Route::put('updatedatakontak/{id}', 'KontakController@update');
    Route::put('updatedatajadwal/{id}', 'JadwalController@update');
    Route::put('updatedatascore/{id}', 'PertandinganController@update');
    Route::get('/detaildatajadwal/{id}', 'PertandinganController@show');

    Route::group(['prefix' => 'dependent', 'middleware' => ['auth']], function () {
        Route::get('kelas/{id}', 'KelasController@show')->name('kelas.get');
        Route::get('cabor/{id}', 'OlahragaController@show')->name('cabor.get');
        Route::get('kontak/{id}', 'KontakController@show')->name('kontak.get');
        Route::get('jadwal/{id}', 'JadwalController@show')->name('jadwal.get');
        Route::get('detailscore/{id}', 'PertandinganController@shows')->name('result.get');
    });

    Route::get('debug', 'HomeController@debug');


});

Route::get('/', function () {
    return redirect('/home');
});
