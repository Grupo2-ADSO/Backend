<?php

use App\Http\Controllers\evaluacioncontroller;
use App\Http\Controllers\historialController;
use App\Http\Controllers\ordenesdetrabajocontroller;
use App\Http\Controllers\reportecontroller;
use App\Http\Controllers\rolcontroller;
use App\Http\Controllers\usuariocontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InformacionRolController;
use Illuminate\Http\Request;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\habitacionesController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('roles', rolcontroller::class);
Route::apiResource('usuario', usuariocontroller::class);
Route::apiResource('ordenes', ordenesdetrabajocontroller::class);
Route::apiResource('reportes', reportecontroller::class);
Route::apiResource('evaluacion', evaluacioncontroller::class);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/informacion-por-rol',[InformacionRolController::class, 'informacionPorRol']);
Route::get('/ambientes', [AmbienteController::class, 'index']);
Route::get('/habitaciones', [habitacionesController::class, 'index']);
Route::get('/evidencias', [EvidenciaController::class, 'index']);
Route::get('/historial', [historialController::class, 'index']);
Route::post('/ambientes', [AmbienteController::class, 'store']);
Route::post('/evidencias', [EvidenciaController::class, 'store']);
Route::post('/habitaciones', [habitacionesController::class, 'store']);
Route::post('/historial', [historialController::class, 'store']);
Route::get('/ambientes/{id}', [AmbienteController::class, 'show']);
Route::get('/evidencias/{id}', [EvidenciaController::class, 'show']);
Route::get('/habitaciones/{id}', [habitacionesController::class, 'show']);
Route::get('/historial/{id}', [historialController::class, 'show']);
Route::put('/ambientes/{id}', [AmbienteController::class, 'update']);
Route::put('/evidencias/{id}', [EvidenciaController::class, 'update']);
Route::put('/habitaciones/{id}', [habitacionesController::class, 'update']);
Route::put('/historial/{id}', [historialController::class, 'update']);
Route::post('/evidencias/{id}', [EvidenciaController::class, 'actualizar']);
Route::delete('/ambientes/{id}', [AmbienteController::class, 'destroy']);
Route::delete('/evidencias/{id}', [EvidenciaController::class, 'destroy']);
Route::delete('/habitaciones/{id}', [habitacionesController::class, 'destroy']);
Route::delete('/historial/{id}', [historialController::class, 'destroy']);
