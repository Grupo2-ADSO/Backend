<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;

class ReporteController extends Controller
{
    

    public function index()
    {
        $reportes = reporte::with([
            'usuario',
            'habitaciones',
            'ambiente'
        ])->get();

        return response()->json($reportes);
    }



    public function show($id)
    {
        $reporte = reporte::with([
            'usuario',
            'habitaciones',
            'ambiente'
        ])->findOrFail($id);

        return response()->json($reporte);
    }


    

    public function store(Request $request)
    {
        $usuario = $request->user();

        $request->validate([
            'Tipo' => 'required|string|max:50',

            'fecha_registro' => 'required|date',

           'habitaciones_No_habitacion' => [
                'nullable',
                'integer',
                'exists:habitaciones,No_habitacion',
                'required_without:ambientes_id_ambiente'
            ],

             'ambientes_id_ambiente' => [
                'nullable',
                'integer',
                'exists:ambientes,id_ambiente',
                'required_without:habitaciones_No_habitacion'
            ],

            'usuario_IdUsuario' =>
                'required|integer|exists:usuarios,IdUsuario',
        ]);

        $reporte = reporte::create([
            'Tipo' => $request->Tipo,
            'fecha_registro' => $request->fecha_registro,

   
            'usuario_IdUsuario' => $usuario->IdUsuario,

            'habitaciones_No_habitacion' =>
                $request->habitaciones_No_habitacion,

            'ambientes_id_ambiente' =>
                $request->ambientes_id_ambiente,
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

           'habitaciones_No_habitacion' => [
                'nullable',
                'integer',
                'exists:habitaciones,No_habitacion',
                'required_without:ambientes_id_ambiente'
            ],

             'ambientes_id_ambiente' => [
                'nullable',
                'integer',
                'exists:ambientes,id_ambiente',
                'required_without:habitaciones_No_habitacion'
            ],

            'usuario_IdUsuario' =>
                'required|integer|exists:usuarios,IdUsuario',
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
