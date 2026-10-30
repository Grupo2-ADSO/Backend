<?php

namespace App\Http\Controllers;

use App\Models\historial;
use Illuminate\Http\Request;

class historialController extends Controller
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

        $idRol = $usuario->rol->IdRol;

        
        if ($idRol == 1 || $idRol == 2) {

            $historial = historial::all();

        
        } elseif ($idRol == 3) {

            $historial = historial::where(
                'usuario_IdUsuario',
                $usuario->IdUsuario
            )->get();

        } else {

            return response()->json([
                "resultado" => "error",
                "mensaje" => "Rol no autorizado."
            ], 403);
        }

        return response()->json([
            "resultado" => "ok",
            "datos" => $historial
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            "resultado" => "error",
            "mensaje" => "No fue posible encontrar el historial.",
            "error" => $e->getMessage()
        ], 500);
    }
}

    public function show($id)
    {
        try {
            $historial = historial::find($id);

            if (!$historial) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El historial solisitado no existe"
                ], 404);
            }

            return response()->json([
                "resultado" => "Ok",
                "datos" => $historial
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible encontrar el historial.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $historial = historial::find($id);

            if (!$historial) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El historial solicitado no existe"
                ], 404);
            }

            if ($request->has('id_orden')) {
                $historial->id_orden = $request->id_orden;
            }

            if ($request->has('estado')) {
                $historial->estado = $request->estado;
            }

            if ($request->has('fecha')) {
                $historial->fecha = $request->fecha;
            }

            if ($request->has('observaciones')) {
                $historial->observaciones = $request->observaciones;
            }

            if ($request->has('usuario_IdUsuario')) {
                $historial->usuario_IdUsuario = $request->usuario_IdUsuario;
            }

            $historial->save();


            return response()->json([
                "resultado" => "Ok",
                "mensaje" => "El historial se actualizo correctamente.",
                "datos" => $historial
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible actualizar el historial.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $historial = historial::find($id);

            if (!$historial) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El historial solicitado no existe"
                ], 400);
            }

            $historial->delete();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "El historial se ha eliminado correctamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible eliminar el historial.",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}