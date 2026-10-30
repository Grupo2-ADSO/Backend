<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\habitaciones;

class habitacionesController extends Controller
{
public function index(Request $request)
{
    try {

        $usuario = $request->user();

        $usuario->load('rol');

        if (!$usuario->rol) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "El usuario no tiene un rol asignado."
            ], 403);
        }

        $idRol = (int) $usuario->rol->IdRol;

        
        if ($idRol === 1 || $idRol === 2) {

            $habitaciones = habitaciones::all();

        
        } elseif ($idRol === 3) {

            $habitacionesIds = \App\Models\ordenesdetrabajo::where(
                'usuario_IdUsuario',
                $usuario->IdUsuario
            )
            ->pluck('habitaciones_No_habitacion')
            ->unique()
            ->filter()
            ->values();

            $habitaciones = habitaciones::whereIn(
                'No_habitacion',
                $habitacionesIds
            )->get();

        } else {

            return response()->json([
                "resultado" => "error",
                "mensaje" => "Rol no autorizado."
            ], 403);
        }

        return response()->json([
            "resultado" => "ok",
            "datos" => $habitaciones
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            "resultado" => "error",
            "mensaje" => "No fue posible encontrar las habitaciones.",
            "error" => $e->getMessage()
        ], 500);
    }
}

    public function store(Request $request)
    {
        try {
            $habitacion = habitaciones::create([
                'No_habitacion' => $request->No_habitacion,
                'piso' => $request->piso,
                'tipo_hab' => $request->tipo_hab
            ]);

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "La habitacion se a registrado correctamente.",
                "datos" => $habitacion
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible registrar esta habitacion.",
                "habitacion" => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $habitacion = habitaciones::find($id);

            if (!$habitacion) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "La habitacion solisitado no existe"
                ], 404);
            }

            return response()->json([
                "resultado" => "Ok",
                "datos" => $habitacion
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible encontrar la habitacion.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $habitacion = habitaciones::find($id);

            if (!$habitacion) {
                return response()->json([
                    "resultado" => "error"
                ], 404);
            }

            if ($request->has('piso')) {
                $habitacion->piso = $request->piso;
            }

            if ($request->has('tipo_hab')) {
                $habitacion->tipo_hab = $request->tipo_hab;
            }

            $habitacion->save();


            return response()->json([
                "resultado" => "Ok",
                "mensaje" => "La habitacion se actualizo correctamente.",
                "datos" => $habitacion
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible actualizar la habitacion.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $habitacion = habitaciones::find($id);

            if (!$habitacion) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "La habitacion solicitado no existe"
                ], 400);
            }

            $habitacion->delete();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "La habitacion se ha eliminado correctamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible eliminar la habitacion",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
