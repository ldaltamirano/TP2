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
//Route::add('GET', '/publicaciones', 'PublicacionesController@todos');
//Route::add('GET', '/publicaciones/{id}', 'PublicacionesController@detalle');

//Route::add('POST', '/publicaciones', 'PublicacionesController@crear');
//Route::add('PUT', '/publicaciones/{id}', 'publicacionesController@editar');
//Route::add('DELETE', '/publicaciones/{id}', 'publicacionesController@eliminar');