<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/internal-cameras', 'CameraController@showInternal')->name('showInternal');
Route::get('/external-cameras', 'CameraController@showExternal')->name('showExternal');
Route::get('/camera-detail/{id}/{notification_id?}/{type?}', 'CameraController@cameraDetail')->name('cameraDetail');

Route::post('/save-camera', 'CameraController@store')->name('saveCamera');

Route::post('/save-incident', 'CameraDetailController@saveIncident')->name('saveIncident');
Route::post('/save-maintenance', 'CameraDetailController@saveMaintenance')->name('saveMaintenance');
Route::post('camera-detail/applied', 'CameraDetailController@applied');
Route::delete('/destroy-maintenance/{id}', 'CameraDetailController@destroyMaintenance')->name('destroyMaintenance');
Route::delete('/destroy-incident/{id}', 'CameraDetailController@destroyIncident')->name('destroyIncident');

Route::fallback(function () {
    return redirect('/internal-cameras');
});