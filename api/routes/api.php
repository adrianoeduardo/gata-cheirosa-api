<?php

Route::post('login', 'Api\\Auth\\AuthController@login');

Route::group(['middleware' => 'apiToken'], function () {
    Route::apiResource('usuarios', 'Api\\Usuarios\\UsuariosController');
    Route::post('logout', 'Api\\Auth\\AuthController@logout');
});
