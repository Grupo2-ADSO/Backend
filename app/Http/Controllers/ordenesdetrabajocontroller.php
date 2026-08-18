<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ordenesdetrabajo;

class ordenesdetrabajocontroller extends Controller
{
    
    public function index()
    {
        $ordenes = ordenesdetrabajo::with([
            'usuario',
            'reporte',
            'ambiente',
            'habitacion'
        ])->get();

        return response()->json($ordenes);
    }

    // Mostrar una orden específica
    public function show($id)
    {
        $orden = ordenesdetrabajo::with([
            'usuario',
            'reporte',
            'ambiente',
            'habitacion'
        ])->findOrFail($id);

        return response()->json($orden);
    }


    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:200',
            'prioridad' => 'required|in:alta,media,baja',
            'fecha_creacion' => 'required|date',
            'reportes_IdReporte' => 'required|integer',
            'ambientes_id_ambiente' => 'required|integer',
            'habitaciones_No_habitacion' => 'required|integer',
            'usuario_IdUsuario' => 'required|integer',
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
            'reportes_IdReporte' => 'required|integer',
            'ambientes_id_ambiente' => 'required|integer',
            'habitaciones_No_habitacion' => 'required|integer',
            'usuario_IdUsuario' => 'required|integer',
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
