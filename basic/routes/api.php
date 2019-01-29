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

Route::get('/mensajes','ApiController@mensajes')->name('api.mensajes.index');
Route::get('/users','ApiController@users')->name('api.usuarios.index');
Route::get('/roles','ApiController@roles')->name('api.roles.index');
Route::get('/perfiles','ApiController@perfiles')->name('api.perfiles.index');
