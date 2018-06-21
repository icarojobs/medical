<?php

// Underconstruction Route (require password to access)
Route::group(['middleware' => 'under-construction'], function () {

    // Frontend Routes
    Route::group(['namespace' => 'Site'], function(){
        Route::get('/', 'FrontendController@index');
        Route::post('save-schedule', 'FrontendController@saveSchedule');
        Route::post('get-schedules', 'FrontendController@getSchedules');
    });

// Backend Routes
    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function()
    {
        // Backpack\CRUD: Define the resources for the entities you want to CRUD.
        CRUD::resource('patient', 'PatientCrudController');
        CRUD::resource('doctor', 'DoctorCrudController');
        CRUD::resource('schedule', 'ScheduleCrudController');
    });

});



