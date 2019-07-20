<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rutas para redes sociales
Route::get('login/{provider}', 'SocialiteController@redirectToProvider');
Route::get('login/{provider}/callback', 'SocialiteController@handleProviderCallback');

//restriccion de acceso por grupo... esta grupo especifica que debe iniciar sesion para acceder a ellas
Route::group(['middleware' => ['auth','admin']], function () { //admin es un middleware que yo cree
    //rutas locaciones
	Route::get('/locations', 'LocationController@index');
	Route::post('/locations', 'LocationController@store');
	Route::delete('/locations/{location}', 'LocationController@destroy');
	Route::get('/locations/{location}', 'LocationController@edit');//obtiene los datos a actualizar
	Route::put('/locations/{location}', 'LocationController@update');//actualiza la informacion


	//rutas items
	Route::get('/items', 'ItemController@index');
	Route::post('/items', 'ItemController@store');
	Route::delete('/items/{item}', 'ItemController@destroy');
	Route::get('/items/{item}', 'ItemController@edit');
	Route::put('/items/{item}', 'ItemController@update');

	//descarga de archivo excel
	Route::get('/items/{item}/prices', 'PriceController@download');
});

//acceso solo a personas logeadas
Route::group(['middleware' => ['auth']], function () { 
    //rutas 
	Route::post('/prices', 'PriceController@store');
	Route::delete('/prices/{price}', 'PriceController@destroy');

	Route::get('/monitor', 'MonitorController@index')->name('monitor');

});
