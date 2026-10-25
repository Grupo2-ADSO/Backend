<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                'Telefono' => $usuario->Telefono,
                'FotoPerfil' => $usuario->FotoPerfil
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
            'Telefono' => ['required', 'regex:/^[0-9]{10}$/'],
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

    public function subirFotoPerfil(Request $request)
    {
        $request->validate([
            'FotoPerfil' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $usuario = $request->user();
        $usuario->load('rol');

        if (!$usuario->rol) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El usuario no tiene un rol asignado.'
            ], 403);
        }

        $rol = strtolower($usuario->rol->nombre);

        if ($rol === 'administrador') {
            $carpeta = 'fotos-perfil/administrador';
        } elseif ($rol === 'supervisor') {
            $carpeta = 'fotos-perfil/supervisor';
        } elseif ($rol === 'operario') {
            $carpeta = 'fotos-perfil/operario';
        } else {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El rol del usuario no es válido.'
            ], 403);
        }

        $fotoAnterior = $usuario->FotoPerfil;

        $archivo = $request->file('FotoPerfil');

        $nombreArchivo = $usuario->IdUsuario . '_' . Str::uuid()
            . '.' . $archivo->extension();

        $rutaNueva = Storage::disk('public')->putFileAs(
            $carpeta,
            $archivo,
            $nombreArchivo
        );

        if (!$rutaNueva) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'No se pudo guardar la fotografia.'
            ], 500);
        }

        $usuario->FotoPerfil = $rutaNueva;
        $usuario->save();

        if (
            $fotoAnterior &&
            Str::startsWith($fotoAnterior, [
                'fotos-perfil/administrador/',
                'fotos-perfil/supervisor/',
                'fotos-perfil/operario/'
            ])
        ) {
            Storage::disk('public')->delete($fotoAnterior);
        }

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Foto de perfil actualizada correctamente.',
            'FotoPerfil' => $usuario->FotoPerfil
        ]);
    }

    public function eliminarFotoPerfil(Request $request)
    {
        $usuario = $request->user();

        $fotoAnterior = $usuario->FotoPerfil;

        $usuario->FotoPerfil = null;
        $usuario->save();

        if (
            $fotoAnterior &&
            Str::startsWith($fotoAnterior, [
                'fotos-perfil/administrador/',
                'fotos-perfil/supervisor/',
                'fotos-perfil/operario/'
            ])
        ) {
            Storage::disk('public')->delete($fotoAnterior);
        }

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Foto de perfil eliminada correctamente.',
            'FotoPerfil' => null
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