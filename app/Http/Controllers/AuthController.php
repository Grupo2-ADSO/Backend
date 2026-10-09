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

        if (!Hash::check($request->Contrasena, $usuario->contrasena)) {
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


        $token = $usuario->createToken('api-token')->plainTextToken;

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Inicio de sesión correcto.',

            'token' => $token,

            'usuario' => [
                'IdUsuario' => $usuario->IdUsuario,
                'Nombre' => $usuario->Nombre,
                'Apellidos' => $usuario->Apellidos,
                'Correo' => $usuario->Correo,
                'Cedula' => $usuario->Cedula,
                'Telefono' => $usuario->Telefono
            ],

            'rol' => [
                'IdRol' => $usuario->rol->IdRol,
                'Nombre' => $usuario->rol->Nombre
            ]
        ], 200);
    }

    public function cambiarCorreo(Request $request)
    {
        $request->validate([
            'Contrasena' => 'required|string',
            'Correo' => 'required|email|max:150|unique:usuarios,Correo'
        ]);

        $usuario = $request->user();

        if (!Hash::check($request->Contrasena, $usuario->contrasena)) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'La contraseña actual es incorrecta.'
            ], 401);
        }

        $usuario->Correo = $request->Correo;
        $usuario->save();

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'correo actualizado correctamente.',
            'Correo' => $usuario->Correo
        ]);
    }

    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'Contrasena' => 'required|string',
            'NuevaContrasena' => 'required|string|min:8|max:20'
        ]);

        $usuario = $request->user();

        if (!Hash::check($request->Contrasena, $usuario->contrasena)) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'La contraseña actual es incorrecta.'
            ], 401);
        }

        $usuario->Contrasena = Hash::make($request->NuevaContrasena);
        $usuario->save();

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Contraseña actualizado correctamente.'
        ]);
    }

    public function cambiarTelefono(Request $request)
    {
        $request->validate([
            'Contrasena' => 'required|string',
            'Telefono' => 'required|string|max:20'
        ]);

        $usuario = $request->user();

        if (!Hash::check($request->Contrasena, $usuario->contrasena)) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'La contraseña actual es incorrecta'
            ], 401);
        }

        $usuario->Telefono = $request->Telefono;
        $usuario->save();

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Telefono actualizado correctamente.',
            'Telefono' => $usuario->Telefono
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Sesión cerrada correctamente.'
        ], 200);
    }
}