<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\habitacionesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ambientes', [AmbienteController::class, 'index']);
Route::get('/habitaciones', [habitacionesController::class, 'index']);
Route::get('/evidencias', [EvidenciaController::class, 'index']);
Route::post('/ambientes', [AmbienteController::class, 'store']);
Route::post('/evidencias', [EvidenciaController::class, 'store']);
Route::post('/habitaciones', [habitacionesController::class, 'store']);
Route::get('/ambientes/{id}', [AmbienteController::class, 'show']);
Route::get('/evidencias/{id}', [EvidenciaController::class, 'show']);
Route::get('/habitaciones/{id}', [habitacionesController::class, 'show']);
Route::put('/ambientes/{id}', [AmbienteController::class, 'update']);
Route::put('/evidencias/{id}', [EvidenciaController::class, 'update']);
Route::put('/habitaciones/{id}', [habitacionesController::class, 'update']);
Route::post('/evidencias/{id}', [EvidenciaController::class, 'actualizar']);
Route::delete('/ambientes/{id}', [AmbienteController::class, 'destroy']);
Route::delete('/evidencias/{id}', [EvidenciaController::class, 'destroy']);
Route::delete('/habitaciones/{id}', [habitacionesController::class, 'destroy']);