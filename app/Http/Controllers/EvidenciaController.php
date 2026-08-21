<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evidencia;
use Illuminate\Support\Facades\Storage;

class EvidenciaController extends Controller
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

        // Administrador y Supervisor: todas las evidencias
        if ($idRol === 1 || $idRol === 2) {

            $evidencias = Evidencia::all();

        // Operario: solo evidencias de sus órdenes
        } elseif ($idRol === 3) {

            $ordenes = \App\Models\ordenesdetrabajo::where(
                'usuario_IdUsuario',
                $usuario->IdUsuario
            )->pluck('idOrden');

            $evidencias = Evidencia::whereIn(
                'ordenes_de_trabajo_idOrden',
                $ordenes
            )->get();

        } else {

            return response()->json([
                "resultado" => "error",
                "mensaje" => "Rol no autorizado."
            ], 403);
        }

        return response()->json([
            "resultado" => "ok",
            "datos" => $evidencias
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            "resultado" => "error",
            "mensaje" => "No fue posible encontrar las evidencias.",
            "error" => $e->getMessage()
        ], 500);
    }
}

    public function store(Request $request)
    {
        try {
            $archivo = $request->file('archivo');

            if (!$archivo) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "No se ha mandado ningun archivo."
                ], 400);
            }

            $extension = $archivo->getClientOriginalExtension();

            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                $tipo = "imagen";
                $carpeta = "evidencias/imagenes";
            } elseif (in_array(strtolower($extension), ['pdf', 'doc', 'docx'])) {
                $tipo = "documento";
                $carpeta = "evidencias/documentos";
            } else {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "El tipo de archivo no esta permitido."
                ], 400);
            }

            $ruta = $archivo->store($carpeta, 'public');

            $evidencia = new Evidencia();

            $evidencia->tipo = $tipo;
            $evidencia->fecha_envio = now();
            $evidencia->ruta_archivo = $ruta;
            $evidencia->observaciones = $request->observaciones;
            $evidencia->ordenes_de_trabajo_idOrden = $request->ordenes_de_trabajo_idOrden;
            $evidencia->evaluacion_idEvaluacion = $request->evaluacion_idEvaluacion;

            $evidencia->save();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "La evidencia se ha registrado correctamente.",
                "datos" => $evidencia
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible registrar la evidencia.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $evidencia = Evidencia::find($id);

            if (!$evidencia) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "La evidencia solisitado no existe"
                ], 404);
            }

            return response()->json([
                "resultado" => "Ok",
                "datos" => $evidencia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible encontrar la evidencia.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

    }

    public function actualizar(Request $request, $id)
    {
        //return response()->json(['evidencia' => $request->all()]);
        try {
            $evidencia = Evidencia::find($id);

            if (!$evidencia) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "La evidencia solisitado no existe"
                ], 404);
            }

            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');
                $extencion = $archivo->getClientOriginalExtension();

                if (in_array(strtolower($extencion), ['jpg', 'jpeg', 'png'])) {
                    $tipo = "imagen";
                    $carpeta = "evidencias/imagenes";
                } elseif (in_array(strtolower($extencion), ['pdf', 'doc', 'docx'])) {
                    $tipo = "documento";
                    $carpeta = "evidencias/documentos";
                } else {
                    return response()->json([
                        "resultado" => "error",
                        "mensaje" => "El tipo de archivo no esta permitido"
                    ], 400);
                }

                $ruta = $archivo->store($carpeta, 'public');

                $evidencia->tipo = $tipo;
                $evidencia->fecha_envio = now();
                $evidencia->ruta_archivo = $ruta;
            }

            if ($request->has('observacion')) {
                $evidencia->observaciones = $request->observacion;
            }

            if ($request->has('ordenes_de_trabajo_idOrden')) {
                $evidencia->ordenes_de_trabajo_idOrden = $request->ordenes_de_trabajo_idOrden;
            }

            if ($request->has('evaluacion_idEvaluacion')) {
                $evidencia->evaluacion_idEvaluacion = $request->evaluacion_idEvaluacion;
            }

            $evidencia->save();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "La evidencia se ha actualizado correctamente",
                "datos" => $evidencia
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible actualizar la evidencia",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $evidencia = Evidencia::find($id);

            if (!$evidencia) {
                return response()->json([
                    "resultado" => "error",
                    "mensaje" => "La evidencia solicitado no existe"
                ], 400);
            }

            Storage::disk('public')->delete($evidencia->ruta_archivo);

            $evidencia->delete();

            return response()->json([
                "resultado" => "ok",
                "mensaje" => "La evidencia se ha eliminado correctamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "resultado" => "error",
                "mensaje" => "No fue posible eliminar la evidencia",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
