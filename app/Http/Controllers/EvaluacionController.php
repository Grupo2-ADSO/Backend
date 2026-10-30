<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\evaluacion;

class evaluacioncontroller extends Controller
{

    public function index()
    {
        $evaluaciones = evaluacion::all();

        return response()->json($evaluaciones);
    }


    public function show($id)
    {
        $evaluacion = evaluacion::findOrFail($id);

        return response()->json($evaluacion);
    }


    public function store(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|string|max:15',
            'fecha_evaluacion' => 'required|date',
        ]);

        $evaluacion = evaluacion::create([
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
            'fecha_evaluacion' => $request->fecha_evaluacion,
        ]);

        return response()->json([
            'mensaje' => 'Evaluación creada correctamente',
            'evaluacion' => $evaluacion
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $evaluacion = evaluacion::findOrFail($id);

        $request->validate([
            'comentario' => 'required|string|max:500',
            'calificacion' => 'required|string|max:15',
            'fecha_evaluacion' => 'required|date',
        ]);

        $evaluacion->update([
            'comentario' => $request->comentario,
            'calificacion' => $request->calificacion,
            'fecha_evaluacion' => $request->fecha_evaluacion,
        ]);

        return response()->json([
            'mensaje' => 'Evaluación actualizada correctamente',
            'evaluacion' => $evaluacion
        ]);
    }

    public function destroy($id)
    {
        $evaluacion = evaluacion::findOrFail($id);

        $evaluacion->delete();

        return response()->json([
            'mensaje' => 'Evaluación eliminada correctamente'
        ]);
    }
}
