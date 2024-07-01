<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::get('contactos', 'Api\V1\ContactoController@index');
    Route::get('contactos/search/{id}', 'Api\V1\ContactoController@search');
    Route::post('contactos/store', 'Api\V1\ContactoController@store');
    Route::post('contactos/update/{id}', 'Api\V1\ContactoController@update');
    Route::delete('contactos/delete/{id}', 'Api\V1\ContactoController@destroy');

});