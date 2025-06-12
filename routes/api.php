<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\PersonajeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('animes',AnimeController::class);
Route::get('animes/{id}/personajes',[AnimeController::class,'getAnimeWithPersonajes']);

Route::apiResource('personajes',PersonajeController::class);
