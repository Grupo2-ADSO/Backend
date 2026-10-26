<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class VerificarCorreoController extends Controller
{
    public function __invoke(Request $request, string $id, string $hash)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El enlace es invalido o ha caducado.'
            ], 403);
        }

        $usuario = usuario::find($id);

        if (
            !$usuario ||
            !$usuario->CorreoPendiente ||
            !hash_equals(sha1($usuario->CorreoPendiente), $hash)
        ) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El enlace no es valido para este correo.'
            ], 403);
        }

        $usuario->Correo = $usuario->CorreoPendiente;
        $usuario->CorreoPendiente = null;
        $usuario->CorreoVerificadoEn = now();
        $usuario->save();

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Correo verificado correctamente.'
        ]);
    }
}
