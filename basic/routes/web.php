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

Route::get('/', 'PagesController@home')->name('index');

Route::get('saludos/{nombre?}','PagesController@saludo')->where('nombre',"[A-Aa-z]+")->name('saludo');

$controlador = 'MensajesControllerV2';
//$controlador = 'MensajesController';

Route::resource('mensajes',$controlador)->parameters([
    'mensajes' => 'mensaje'
]);

Route::resource('usuarios','UsuariosController')->parameters([
    'usuarios' => 'usuario'
]);

Route::resource('roles','RolesController')->parameters([
    'roles' => 'role'
]);

Route::resource('perfiles','PerfilesController')->parameters([
    'perfiles' => 'perfil'
]);

Route::post('notas/{entityId}/attach','NotasController@attach')->name('notas.attach');

Route::resource('notas','NotasController')->parameters([
    'notas' => 'nota'
]);

Route::resource('zonas','ZonasController')->parameters([
    'zonas' => 'zona'
]);

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register','Auth\RegisterController@register')->name('register.post');

Route::post('logout','Auth\LoginController@logout')->name('logout');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
