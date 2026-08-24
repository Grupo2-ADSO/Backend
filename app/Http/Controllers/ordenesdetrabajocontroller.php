<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ordenesdetrabajo;

class ordenesdetrabajocontroller extends Controller
{

    public function index(Request $request)
    {
        $usuario = $request->user();

        $usuario->load('rol');

        if (!$usuario->rol) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El usuario no tiene un rol asignado.'
            ], 403);
        }

        $idRol = $usuario->rol->IdRol;

        $consulta = ordenesdetrabajo::with([
            'usuario',
            'reporte',
            'ambiente',
            'habitaciones'
        ]);

        // Administrador y Supervisor
        if ($idRol == 1 || $idRol == 2) {

            $ordenes = $consulta->get();

            // Operario
        } elseif ($idRol == 3) {

            $ordenes = $consulta
                ->where('usuario_IdUsuario', $usuario->IdUsuario)
                ->get();

        } else {

            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'Rol no autorizado.'
            ], 403);
        }

        return response()->json([
            'resultado' => 'ok',
            'datos' => $ordenes
        ], 200);
    }


    public function show(Request $request, $id)
    {
        $usuario = $request->user();

        $usuario->load('rol');

        $rol = strtolower(trim($usuario->rol->Nombre));

        $orden = ordenesdetrabajo::with([
            'usuario',
            'reporte',
            'ambiente',
            'habitaciones'
        ])->find($id);

        if (!$orden) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'La orden no existe.'
            ], 404);
        }



        if (
            $rol === 'operario' &&
            $orden->usuario_IdUsuario != $usuario->IdUsuario
        ) {

            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'No tienes permiso para consultar esta orden.'
            ], 403);
        }

        return response()->json([
            'resultado' => 'ok',
            'orden' => $orden
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:200',
            'prioridad' => 'required|in:alta,media,baja',
            'fecha_creacion' => 'required|date',

            'reportes_IdReporte' =>
                'required|integer|exists:reportes,IdReporte',

            'ambientes_id_ambiente' =>
                'required|integer|exists:ambientes,id_ambiente',

            'habitaciones_No_habitacion' =>
                'required|integer|exists:habitaciones,No_habitacion',

            'usuario_IdUsuario' =>
                'required|integer|exists:usuarios,IdUsuario',
        ]);

        $orden = ordenesdetrabajo::create([
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'fecha_creacion' => $request->fecha_creacion,
            'reportes_IdReporte' => $request->reportes_IdReporte,
            'ambientes_id_ambiente' => $request->ambientes_id_ambiente,
            'habitaciones_No_habitacion' => $request->habitaciones_No_habitacion,
            'usuario_IdUsuario' => $request->usuario_IdUsuario,
        ]);

        return response()->json([
            'mensaje' => 'Orden de trabajo creada correctamente',
            'orden' => $orden
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $orden = ordenesdetrabajo::findOrFail($id);

        $request->validate([
            'descripcion' => 'required|string|max:200',
            'prioridad' => 'required|in:alta,media,baja',
            'fecha_creacion' => 'required|date',
            'reportes_IdReporte' => 'required|integer|exists:reportes,IdReporte',
            'ambientes_id_ambiente' => 'required|integer|exists:ambientes,id_ambiente',
            'habitaciones_No_habitacion' => 'required|integer|exists:habitaciones,No_habitacion',
            'usuario_IdUsuario' => 'required|integer|exists:usuarios,IdUsuario',
        ]);

        $orden->update([
            'descripcion' => $request->descripcion,
            'prioridad' => $request->prioridad,
            'fecha_creacion' => $request->fecha_creacion,
            'reportes_IdReporte' => $request->reportes_IdReporte,
            'ambientes_id_ambiente' => $request->ambientes_id_ambiente,
            'habitaciones_No_habitacion' => $request->habitaciones_No_habitacion,
            'usuario_IdUsuario' => $request->usuario_IdUsuario,
        ]);

        return response()->json([
            'mensaje' => 'Orden de trabajo actualizada correctamente',
            'orden' => $orden
        ]);
    }


    public function destroy($id)
    {
        $orden = ordenesdetrabajo::findOrFail($id);

        $orden->delete();

        return response()->json([
            'mensaje' => 'Orden de trabajo eliminada correctamente'
        ]);
    }
}