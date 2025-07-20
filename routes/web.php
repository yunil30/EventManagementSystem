<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['guest'])->group(function () {
    Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login.submit');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware(['auth.user'])->group(function () {
    Route::get('/', function () {return view('welcome');});
    Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers'])->name('ShowListOfUsers');
    Route::get('/GetActiveUsers', [UserController::class, 'GetActiveUsers']);
    Route::get('/GetUserRecord/{UserID}', [UserController::class, 'GetUserRecord']);

    Route::post('/CreateUserRecord', [UserController::class, 'CreateUserRecord']);
    Route::post('/EditUserRecord/{UserID}', [UserController::class, 'EditUserRecord']);
    Route::post('/RemoveUserRecord/{UserID}', [UserController::class, 'RemoveUserRecord']);
});
