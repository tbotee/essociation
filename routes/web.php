<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Route::view('associations', 'associations')
//    ->middleware(['auth', 'verified'])
//    ->name('associations');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/test', function () {
    $unit = \App\Models\Unit::find(3);
    $unit->waterMeter()->create([
        'water_meter_type_id' => 2,
        'code' => 'alma',
    ]);
});

require __DIR__.'/auth.php';
