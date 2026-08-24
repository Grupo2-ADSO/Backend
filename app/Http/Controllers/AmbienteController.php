<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambiente;

class AmbienteController extends Controller
{
    public function index()
    {
        try {
            $ambientes = Ambiente::all();

            return response()->json([
                "resultado" => "ok",
                "datos" => $ambientes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "Ha ocurrido un error durante la ejecución de la operación.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $ambiente = new Ambiente();

            $ambiente->nombre = $request->nombre;

            $ambiente->save();

            return response()->json([
                "resultado" => "ok",
                "datos" => $ambiente
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "Ha ocurrido un error durante la ejecución de la operación.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $ambiente = Ambiente::find($id);

            if (!$ambiente) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El ambiente solicitado no existe"
                ], 404);
            }

            return response()->json([
                "resultado" => "Ok",
                "datos" => $ambiente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible encontrar el ambiente.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ambiente = Ambiente::find($id);

            if (!$ambiente) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El ambiente solicitado no existe"
                ], 404);
            }

            $ambiente->nombre = $request->nombre;

            $ambiente->save();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "El ambiente se ha actualizado correctamente",
                "datos" => $ambiente
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible actualizar el ambiente",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $ambiente = Ambiente::find($id);

            if (!$ambiente) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El ambiente solicitado no existe"
                ], 404);
            }

            $ambiente->delete();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "Ambiente se ha eliminado correctamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible eliminar el ambiente el ambiente",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
