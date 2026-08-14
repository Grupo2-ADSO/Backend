<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rol;


class rolcontroller extends Controller
{

    //Mostrar todos los registros
    public function index()
    {
        $roles = rol::all();

        return response()->json($roles);
    }

    //Guardar un rol
    public function store(Request $request)
    {

        $request->validate([
            'Nombre' => 'required|max:100'
        ]);

        $rol = rol::create([
            'Nombre' => $request->Nombre
        ]);

        return response()->json($rol,201);
    }

    //Mostrar un registro
    public function show($id)
    {
        $rol = rol::findOrFail($id);

        return response()->json($rol);
    }

    //Actualizar
   public function update(Request $request, $id)
{
    $rol = Rol::where('IdRol', $id)->first();

    if (!$rol) {
        return response()->json([
            'mensaje' => 'Rol no encontrado'
        ], 404);
    }

    $rol->Nombre = $request->Nombre;
    $rol->save();

    return response()->json($rol);
}

    //Eliminar
    public function destroy($id)
{
    $rol = Rol::where('IdRol', $id)->first();

    if (!$rol) {
        return response()->json([
            'mensaje' => 'Rol no encontrado'
        ], 404);
    }

    $rol->delete();

    return response()->json([
        'mensaje' => 'Rol eliminado correctamente'
    ]);
}

}

