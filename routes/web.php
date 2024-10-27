<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('index');
});

Route::get('/settings', fn() => view('settings'));
Route::put('/settings', [DashboardController::class, 'settings']);
