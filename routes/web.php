<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');


Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest')->name('login');
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->middleware('auth');
Route::post('/ideas', [IdeaController::class, 'store'])->middleware('auth');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->middleware('auth');

Route::patch('/steps/{step}', [StepController::class, 'update'])->middleware('auth');


