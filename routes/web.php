<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordsController;

Route::get('/', function () {
    return view('index');
});

Route::get("/settings", fn() => view('settings'));
Route::put("/settings", [DashboardController::class, 'settings']);

Route::post("/login", [DashboardController::class, 'login']);
Route::post("/register", [DashboardController::class, 'register']);

Route::get('/logout', [DashboardController::class, 'logout']);

Route::get('/records', [RecordsController::class, 'index']);
Route::post('/records', [RecordsController::class, 'store']);
Route::delete('/records/{id}', [RecordsController::class, 'destroy']);

Route::get('/leaderboard', [DashboardController::class, 'leaderboard']);
