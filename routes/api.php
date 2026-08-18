<?php

use App\Http\Controllers\evaluacioncontroller;
use App\Http\Controllers\ordenesdetrabajocontroller;
use App\Http\Controllers\reportecontroller;
use App\Http\Controllers\rolcontroller;
use App\Http\Controllers\usuariocontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InformacionRolController;
use Illuminate\Http\Request;


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