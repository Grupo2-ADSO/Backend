<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class usuariocontroller extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $usuarios = usuario::with('rol')->get();

        return response()->json($usuarios);
    }


    // Mostrar un usuario específico
    public function show($id)
    {
        $usuario = usuario::with('rol')->findOrFail($id);

        return response()->json($usuario);
    }


    // Crear un usuario
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Correo' => 'required|email|max:150|unique:usuario,Correo',
            'Contrasena' => 'required|string|min:6|max:100',
            'Estado' => 'nullable|in:Activo,Inactivo',
            'Cedula' => 'required|integer|unique:usuario,Cedula',
            'Telefono' => 'nullable|integer',
            'Rol_IdRol' => 'required|exists:rol,IdRol',
        ]);

        $usuario = usuario::create([
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
            'usuario' => $usuario
        ], 201);
    }


   
    public function update(Request $request, $id)
    {
        $usuario = usuario::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Apellidos' => 'required|string|max:100',
            'Correo' => 'required|email|max:150|unique:usuario,Correo,' . $id . ',IdUsuario',
            'Contrasena' => 'nullable|string|min:6|max:100',
            'Estado' => 'nullable|in:Activo,Inactivo',
            'Cedula' => 'required|integer|unique:usuario,Cedula,' . $id . ',IdUsuario',
            'Telefono' => 'nullable|integer',
            'Rol_IdRol' => 'required|exists:rol,IdRol',
        ]);

        $usuario->Nombre = $request->Nombre;
        $usuario->Apellidos = $request->Apellidos;
        $usuario->Correo = $request->Correo;
        $usuario->Estado = $request->Estado ?? $usuario->Estado;
        $usuario->Cedula = $request->Cedula;
        $usuario->Telefono = $request->Telefono;
        $usuario->Rol_IdRol = $request->Rol_IdRol;

        // Solo cambiar la contraseña si se envía una nueva
        if ($request->filled('Contrasena')) {
            $usuario->Contrasena = Hash::make($request->Contrasena);
        }

        $usuario->save();

        return response()->json([
            'mensaje' => 'Usuario actualizado correctamente',
            'usuario' => $usuario
        ]);
    }


    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = usuario::findOrFail($id);

        $usuario->delete();

        return response()->json([
            'mensaje' => 'Usuario eliminado correctamente'
        ]);
    }
}
