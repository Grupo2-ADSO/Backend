<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'Correo' => 'required|email',
            'Contrasena' => 'required'
        ]);

        $usuario = usuario::with('rol')
            ->where('Correo', $request->Correo)
            ->first();

        if (!$usuario) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'Correo o contraseña incorrectos.'
            ], 401);
        }

        if (!Hash::check($request->Contrasena, $usuario->Contrasena)) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'Correo o contraseña incorrectos.'
            ], 401);
        }

        if (!$usuario->rol) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El usuario no tiene un rol asignado.'
            ], 403);
        }

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Inicio de sesión correcto.',
            'usuario' => [
                'IdUsuario' => $usuario->IdUsuario,
                'Nombre' => $usuario->Nombre,
                'Apellidos' => $usuario->Apellidos,
                'Correo' => $usuario->Correo
            ],
            'rol' => [
                'IdRol' => $usuario->rol->IdRol,
                'Nombre' => $usuario->rol->Nombre
            ]
        ], 200);
    }
}
