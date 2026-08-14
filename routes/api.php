<?php

use App\Http\Controllers\evaluacioncontroller;
use App\Http\Controllers\ordenesdetrabajocontroller;
use App\Http\Controllers\reportecontroller;
use App\Http\Controllers\rolcontroller;
use App\Http\Controllers\usuariocontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('roles', rolcontroller::class);
Route::apiResource('usuario', usuariocontroller::class);
Route::apiResource('ordenes', ordenesdetrabajocontroller::class);
Route::apiResource('reportes', reportecontroller::class);
Route::apiResource('evaluacion', evaluacioncontroller::class);
