<?php
/*
 * Este archivo va a contener TODAS las rutas de
 * nuestra aplicación.
 *
 * Para esto, vamos a crear una clase Route cuya
 * función sea la de registrar y administrar las rutas.
 */
use Redsocial\Core\Route;

Route::add('POST', '/login', 'AuthController@login');
Route::add('POST', '/registrar', 'RegisterController@registrar');
Route::add('GET', '/usuario', 'UserController@obtenerUsuario');
Route::add('GET', '/publicacion', 'PublicacionController@datos');
Route::add('GET', '/publicacion/{id}', 'PublicacionController@detalle');
Route::add('POST', '/publicacion', 'PublicacionController@crear');
Route::add('PUT', '/publicacion/{id}', 'PublicacionController@editar');
Route::add('DELETE', '/publicacion/{id}', 'PublicacionController@eliminar');