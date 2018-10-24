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
    Route::resource('complaints', 'PengaduanController')->except(['edit', 'update']);;
    Route::resource('layanan/kategori', 'LayananController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('diklat', 'DiklatController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('subdiklat', 'SubDiklatController')->except(['create', 'edit', 'show']);
    Route::resource('angkatan', 'AngkatanController');
    Route::resource('kelas', 'KelasController');
    Route::resource('instruktur', 'InstrukturController')->except(['create', 'edit', 'show']);

    Route::group(['prefix' => 'user'], function () {
        Route::resource('siswa', 'SiswaController');
        Route::get('listsiswa', 'SiswaController@listsiswa')->name('siswa.list');
    });

    Route::group(['prefix' => 'user/profile'], function () {
        Route::get('/{username}', 'ProfileController@index')->name('profile');
        Route::get('/{username}/change_password', 'ProfileController@editPassword')->name('edit-password');
        Route::put('/edit/{user}', 'ProfileController@updateProfile')->name('update.profile');
        Route::put('/change_password/{user}', 'ProfileController@updatePassword')->name('update.password');
    });

    Route::group(['prefix' => 'survey'], function () {
        Route::get('/list', 'SurveyController@index')->name('survey.index');
        Route::post('/list', 'SurveyController@store')->name('survey.store')->middleware('superadmin');
        Route::get('/add', 'SurveyController@create')->name('survey.create');
        Route::get('/submission', 'SurveyController@submission')->name('survey.submission');
        Route::get('/result', 'SurveyController@result')->name('survey.result');
    });


    Route::post('complaint-proses', 'PengaduanController@onProcess')->name('complaints.proses');
    Route::post('complaint-done', 'PengaduanController@onDone')->name('complaints.done');

    Route::get('tipeadminlist', 'TipeAdminController@listTipeAdmin')->name('tipeadmin.list')->middleware('superadmin');
    Route::get('listdiklat', 'DiklatController@listdiklat')->name('diklat.list')->middleware('superadmin');
    Route::get('listsubdiklat', 'SubDiklatController@listsubdiklat')->name('subdiklat.list')->middleware('superadmin');
    Route::get('listangkatan', 'AngkatanController@listangkatan')->name('angkatan.list')->middleware('superadmin');
    Route::get('listkategori', 'LayananController@listlayanan')->name('kategori.list')->middleware('superadmin');
    Route::get('listkelas', 'KelasController@listkelas')->name('kelas.list')->middleware('superadmin');

    Route::group(['prefix' => 'dependent', 'middleware' => ['auth']], function () {
        Route::get('subdiklat/{id}', 'SubDiklatController@getSubdiklat')->name('subdiklat.get');
        Route::get('angkatan/{id}', 'AngkatanController@getAngkatan')->name('angkatan.get');
        Route::get('kelas/{id}', 'KelasController@getKelas')->name('kelas.get');
        Route::get('siswa/{id}', 'SiswaController@getSiswa')->name('siswa.get');
        Route::get('instruktur/{id}', 'InstrukturController@getKelasInstruktur')->name('instruktur.get');
    });

    Route::get('debug', 'HomeController@debug');


});

Route::get('/', function () {
    return redirect('/home');
});
