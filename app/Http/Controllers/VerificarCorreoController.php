<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        if (!$usuario || !hash_equals(sha1($usuario->Correo), $hash)) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El enlace no es valido para este correo.'
            ], 403);
        }

        if (!$usuario->CorreoVerificadoEn) {
            $usuario->CorreoVerificadoEn = now();
            $usuario->save();
        }

        return response()->json([
            'resultado' => 'ok',
            'mensaje' => 'Correo verificado correctamente.'
        ]);
    }
}
