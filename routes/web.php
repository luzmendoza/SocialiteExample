<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rutas para redes sociales
Route::get('login/{provider}', 'SocialiteController@redirectToProvider');
Route::get('login/{provider}/callback', 'SocialiteController@handleProviderCallback');

//rutas locaciones
Route::get('/locations', 'LocationController@index');
Route::post('/locations', 'LocationController@store');
Route::delete('/locations/{location}', 'LocationController@destroy');

//rutas items
Route::get('/items', 'ItemController@index');
Route::post('/items', 'ItemController@store');
Route::delete('/items/{item}', 'ItemController@destroy');