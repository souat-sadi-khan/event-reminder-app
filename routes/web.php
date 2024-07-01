<?php

Route::get('/', 'CalendarController@index');

// Offline data sync
Route::post('events', 'CalendarController@syncEvents');

// Calendar Import
Route::get('calendars/import', 'CalendarController@showImportForm')->name('calendars.import.form');
Route::post('calendars/import', 'CalendarController@import')->name('calendars.import');

Route::resource('calendars', 'CalendarController');

// System configuration
Route::get('system-configuration', 'SettingsController@index')->name('system-configuration');
Route::post('settings-store', 'SettingsController@store')->name('settings.store');