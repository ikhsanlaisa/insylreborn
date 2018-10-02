<?php


Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/login', function () {
    return view('auth.login');
})->name('login.index');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::resource('user/siswa', 'UserController');
    Route::resource('news', 'BeritaController');
    Route::resource('user/admin', 'AdminController');
    Route::resource('complaints', 'PengaduanController')->except(['edit','update']);;
    Route::resource('siswas', 'SiswaController')->only(['index']);
    Route::resource('layanan/kategori', 'LayananController')->only(['index','store','update','destroy']);
    Route::resource('diklat', 'DiklatController')->only(['index','store','update','destroy']);
    Route::resource('subdiklat', 'SubDiklatController');
    Route::resource('angkatan', 'AngkatanController');
    Route::resource('kelas', 'KelasController');

    Route::group(['prefix' => 'user/profile'], function () {
        Route::get('/{username}', 'ProfileController@index')->name('profile');
        Route::get('/{username}/edit', 'ProfileController@edit')->name('edit-profile');
        Route::get('/{username}/change_password', 'ProfileController@editPassword')->name('edit-password');
        Route::put('/edit/{profile}','ProfileController@updateProfile')->name('update.profile');
        Route::put('/change_password/{user}','ProfileController@updatePassword')->name('update.password');
    });

    Route::post('complaint-proses', 'PengaduanController@onProcess')->name('complaints.proses');
    Route::post('complaint-done', 'PengaduanController@onDone')->name('complaints.done');

    Route::get('tipeadminlist', 'TipeAdminController@listTipeAdmin')->name('tipeadmin.list')->middleware('superadmin');

});

Route::get('/', function () {
    return redirect('/home');
});
