<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reporte;

class reportecontroller extends Controller
{

    public function index()
    {
        $reportes = reporte::with([
            'usuario',
            'habitacion',
            'ambiente'
        ])->get();

        return response()->json($reportes);
    }


    public function show($id)
    {
        $reporte = reporte::with([
            'usuario',
            'habitacion',
            'ambiente'
        ])->findOrFail($id);

        return response()->json($reporte);
    }


    public function store(Request $request)
    {
        $request->validate([
            'Tipo' => 'required|string|max:50',
            'fecha_registro' => 'required|date',
            'usuario_IdUsuario' => 'required|integer',
            'habitaciones_No_habitacion' => 'required|integer',
            'ambientes_id_ambiente' => 'required|integer',
        ]);

        $reporte = reporte::create([
            'Tipo' => $request->Tipo,
            'fecha_registro' => $request->fecha_registro,
            'usuario_IdUsuario' => $request->usuario_IdUsuario,
            'habitaciones_No_habitacion' => $request->habitaciones_No_habitacion,
            'ambientes_id_ambiente' => $request->ambientes_id_ambiente,
        ]);

        return response()->json([
            'mensaje' => 'Reporte creado correctamente',
            'reporte' => $reporte
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $reporte = reporte::findOrFail($id);

        $request->validate([
            'Tipo' => 'required|string|max:50',
            'fecha_registro' => 'required|date',
            'usuario_IdUsuario' => 'required|integer',
            'habitaciones_No_habitacion' => 'required|integer',
            'ambientes_id_ambiente' => 'required|integer',
        ]);

        $reporte->update([
            'Tipo' => $request->Tipo,
            'fecha_registro' => $request->fecha_registro,
            'usuario_IdUsuario' => $request->usuario_IdUsuario,
            'habitaciones_No_habitacion' => $request->habitaciones_No_habitacion,
            'ambientes_id_ambiente' => $request->ambientes_id_ambiente,
        ]);

        return response()->json([
            'mensaje' => 'Reporte actualizado correctamente',
            'reporte' => $reporte
        ]);
    }


    public function destroy($id)
    {
        $reporte = reporte::findOrFail($id);

        $reporte->delete();

        return response()->json([
            'mensaje' => 'Reporte eliminado correctamente'
        ]);
    }
}
