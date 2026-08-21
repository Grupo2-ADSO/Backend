<?php

use App\Http\Controllers\evaluacioncontroller;
use App\Http\Controllers\historialController;
use App\Http\Controllers\ordenesdetrabajocontroller;
use App\Http\Controllers\reportecontroller;
use App\Http\Controllers\rolcontroller;
use App\Http\Controllers\usuariocontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InformacionRolController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\habitacionesController;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {



    Route::get('/informacion-por-rol', [
        InformacionRolController::class,
        'informacionPorRol'
    ]);


    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::get('/usuario', [
            usuariocontroller::class,
            'index'
        ]);

        Route::get('/usuario/{id}', [
            usuariocontroller::class,
            'show'
        ]);
    });

    Route::middleware('role:administrador')->group(function () {

        Route::post('/usuario', [
            usuariocontroller::class,
            'store'
        ]);

        Route::put('/usuario/{id}', [
            usuariocontroller::class,
            'update'
        ]);

        Route::delete('/usuario/{id}', [
            usuariocontroller::class,
            'destroy'
        ]);
    });


    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::get('/roles', [
            rolcontroller::class,
            'index'
        ]);

        Route::get('/roles/{id}', [
            rolcontroller::class,
            'show'
        ]);
    });

    Route::middleware('role:administrador')->group(function () {

        Route::post('/roles', [
            rolcontroller::class,
            'store'
        ]);

        Route::put('/roles/{id}', [
            rolcontroller::class,
            'update'
        ]);

        Route::delete('/roles/{id}', [
            rolcontroller::class,
            'destroy'
        ]);
    });




    Route::middleware('role:administrador,supervisor,operario')->group(function () {

        Route::get('/ordenes', [
            ordenesdetrabajocontroller::class,
            'index'
        ]);


        Route::get('/ordenes/{id}', [
            ordenesdetrabajocontroller::class,
            'show'
        ]);


    });

    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::get('/ordenes/{id}', [
            ordenesdetrabajocontroller::class,
            'store'
        ]);



        Route::put('/ordenes/{id}', [
            ordenesdetrabajocontroller::class,
            'update'
        ]);

        Route::delete('/ordenes/{id}', [
            ordenesdetrabajocontroller::class,
            'destroy'
        ]);

    });



    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::get('/reportes', [
            reportecontroller::class,
            'index'
        ]);

        Route::get('/reportes/{id}', [
            reportecontroller::class,
            'show'
        ]);

        Route::put('/reportes/{id}', [
            reportecontroller::class,
            'update'
        ]);

        Route::delete('/reportes/{id}', [
            reportecontroller::class,
            'destroy'
        ]);
    });



    Route::middleware('role:administrador,supervisor,operario')->group(function () {

        Route::post('/reportes', [
            reportecontroller::class,
            'store'
        ]);
    });




    Route::middleware('role:administrador,supervisor,operario')->group(function () {

        Route::get('/evaluacion', [
            evaluacioncontroller::class,
            'index'
        ]);

        Route::get('/evaluacion/{id}', [
            evaluacioncontroller::class,
            'show'
        ]);

    });


    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::post('/evaluacion', [
            evaluacioncontroller::class,
            'store'
        ]);

        Route::put('/evaluacion/{id}', [
            evaluacioncontroller::class,
            'update'
        ]);

        Route::delete('/evaluacion/{id}', [
            evaluacioncontroller::class,
            'destroy'
        ]);
    });



    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::get('/ambientes', [
            AmbienteController::class,
            'index'
        ]);

        Route::get('/ambientes/{id}', [
            AmbienteController::class,
            'show'
        ]);
    });

    Route::middleware('role:administrador')->group(function () {

        Route::post('/ambientes', [
            AmbienteController::class,
            'store'
        ]);

        Route::put('/ambientes/{id}', [
            AmbienteController::class,
            'update'
        ]);

        Route::delete('/ambientes/{id}', [
            AmbienteController::class,
            'destroy'
        ]);
    });


    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::get('/habitaciones', [
            habitacionesController::class,
            'index'
        ]);

        Route::get('/habitaciones/{id}', [
            habitacionesController::class,
            'show'
        ]);
    });

    Route::middleware('role:administrador')->group(function () {

        Route::post('/habitaciones', [
            habitacionesController::class,
            'store'
        ]);

        Route::put('/habitaciones/{id}', [
            habitacionesController::class,
            'update'
        ]);

        Route::delete('/habitaciones/{id}', [
            habitacionesController::class,
            'destroy'
        ]);
    });



    Route::middleware('role:administrador,supervisor,operario')->group(function () {

        Route::get('/evidencias', [
            EvidenciaController::class,
            'index'
        ]);


        Route::get('/evidencias/{id}', [
            EvidenciaController::class,
            'show'
        ]);

        Route::post('/evidencias', [
            EvidenciaController::class,
            'store'
        ]);


    });



    Route::middleware('role:administrador,supervisor')->group(function () {


        Route::put('/evidencias/{id}', [
            EvidenciaController::class,
            'update'
        ]);


        Route::delete('/evidencias/{id}', [
            EvidenciaController::class,
            'destroy'
        ]);
    });




    Route::middleware('role:administrador,supervisor,operario')->group(function () {

        Route::get('/historial', [
            historialController::class,
            'index'
        ]);

        Route::get('/historial/{id}', [
            historialController::class,
            'show'
        ]);


    });



    Route::middleware('role:administrador,supervisor')->group(function () {

        Route::post('/historial', [
            historialController::class,
            'store'
        ]);

        Route::put('/historial/{id}', [
            historialController::class,
            'update'
        ]);

        Route::delete('/historial/{id}', [
            historialController::class,
            'destroy'
        ]);
    });




    Route::post('/logout', [
        AuthController::class,
        'logout'
    ]);

});
