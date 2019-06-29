<?php

Route::get('/vehicles/{model_year}/{manufacturer}/{model}', 'VehicleController@getListVehicles')->name('listVehicles');

Route::post('/vehicles', 'VehicleController@postListVehicles')->name('listVehicles');
