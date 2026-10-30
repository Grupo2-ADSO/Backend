<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();

        return response()->json($usuarios);
    }


    // Mostrar un usuario específico
    public function show($id)
    {
        $usuarios = Usuario::with('rol')->findOrFail($id);

        return response()->json($usuarios);
    }


    // Crear un usuario
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Correo' => 'required|email|max:150|unique:usuarios,Correo',
            'Contrasena' => 'required|string|min:6|max:100',
            'Estado' => 'nullable|in:Activo,Inactivo',
            'Cedula' => 'required|integer|unique:usuarios,Cedula',
            'Telefono' => 'nullable|integer',
            'Rol_IdRol' => 'required|exists:rols,IdRol',
        ]);

        $usuarios = Usuario::create([
            'Nombre' => $request->Nombre,
            'Apellidos' => $request->Apellidos,
            'Correo' => $request->Correo,
            'Contrasena' => Hash::make($request->Contrasena),
            'Estado' => $request->Estado ?? 'Activo',
            'Cedula' => $request->Cedula,
            'Telefono' => $request->Telefono,
            'Rol_IdRol' => $request->Rol_IdRol,
        ]);

        return response()->json([
            'mensaje' => 'Usuario creado correctamente',
            'usuario' => $usuarios
        ], 201);
    }


   
    public function update(Request $request, $id)
    {
        $usuarios = Usuario::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Correo' => 'required|email|max:150|unique:usuarios,Correo,' . $id . ',IdUsuario',
            'Contrasena' => 'nullable|string|min:6|max:100',
            'Estado' => 'nullable|in:Activo,Inactivo',
            'Cedula' => 'required|integer|unique:usuarios,Cedula,' . $id . ',IdUsuario',
            'Telefono' => 'nullable|integer',
            'Rol_IdRol' => 'required|exists:rols,IdRol',
        ]);

        $usuarios->Nombre = $request->Nombre;
        $usuarios->Apellidos = $request->Apellidos;
        $usuarios->Correo = $request->Correo;
        $usuarios->Estado = $request->Estado ?? $usuarios->Estado;
        $usuarios->Cedula = $request->Cedula;
        $usuarios->Telefono = $request->Telefono;
        $usuarios->Rol_IdRol = $request->Rol_IdRol;

        // Solo cambiar la contraseña si se envía una nueva
        if ($request->filled('Contrasena')) {
            $usuarios->Contrasena = Hash::make($request->Contrasena);
        }

        $usuarios->save();

        return response()->json([
            'mensaje' => 'Usuario actualizado correctamente',
            'usuario' => $usuarios
        ]);
    }


    // Eliminar un usuario
    public function destroy($id)
    {
        $usuarios = Usuario::findOrFail($id);

        $usuarios->delete();

        return response()->json([
            'mensaje' => 'Usuario eliminado correctamente'
        ]);
    }
}
