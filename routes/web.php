<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/internal-cameras', 'CameraController@showInternal')->name('showInternal');
Route::get('/external-cameras', 'CameraController@showExternal')->name('showExternal');
Route::get('/camera-detail/{id}/{notification_id?}/{type?}', 'CameraController@cameraDetail')->name('cameraDetail');

Route::post('/save-camera', 'CameraController@store')->name('saveCamera');

Route::post('/save-incedent', 'CameraDetailController@saveIncident')->name('saveIncident');
Route::post('/save-maintenance', 'CameraDetailController@saveMaintenance')->name('saveMaintenance');
Route::post('camera-detail/applied', 'CameraDetailController@applied');

Route::fallback(function () {
    return view('error');
});