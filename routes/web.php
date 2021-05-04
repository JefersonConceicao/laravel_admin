<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'] , function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['as' => 'users::', 'prefix' => 'users'], function(){
        Route::get('/', 'UsersController@index')->name('index');
        Route::get('/create', 'UsersController@create')->name('create');
        Route::post('/store', 'UsersController@store')->name('store');
        Route::get('/edit/{id}','UsersController@edit')->name('edit');
        Route::put('/update/{id}', 'UsersController@update')->name('update');
        Route::delete('/destroy/{id}','UsersController@destroy')->name('delete');
        Route::get('/view/{id}', 'UsersController@show')->name('view');
        Route::get('/perfil', 'UsersController@profile')->name('profile');
        Route::put('/changePassword', 'UsersController@changePassword')->name('changePassword');
        Route::post('uploadPhotoProfile', 'UsersController@uploadPhotoProfile')->name('uploadPhotoProfile');
    });

    Route::group(['as' => 'permissoes::', 'prefix' => 'permissoes'], function(){
        Route::get('/', 'PermissoesController@index')->name('index');
        Route::get('/create', 'PermissoesController@create')->name('create');
    });

    Route::group(['as' => 'modulos::', 'prefix' => 'modulos'], function(){
        Route::get('/', 'ModulosController@index')->name('index');
        Route::get('/create', 'ModulosController@create')->name('create');
        Route::post('/store', 'ModulosController@store')->name('store');
        Route::get('/edit/{id}', 'ModulosController@edit')->name('edit');
        Route::put('/update/{id}', 'ModulosController@update')->name('update');
        Route::delete('/delete/{id}', 'ModulosController@destroy')->name('delete');
    });

    Route::group(['as' => 'funcionalidades::', 'prefix' => 'funcionalidades'], function(){
        Route::get('/', 'FuncionalidadesController@index')->name('index');
    });
});



