<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class VerificarCorreoController extends Controller
{
    public function __invoke(Request $request, string $id, string $hash)
    {
        if (!$request->hasValidSignature()) {
            return redirect(
                env('FRONTEND_URL') .
                '/verificar-correo?estado=error&mensaje=' .
                urlencode('El enlace es invalido o ha caducado.')
            );
        }

        $usuario = Usuario::find($id);

        if (
            !$usuario ||
            !$usuario->CorreoPendiente ||
            !hash_equals(sha1($usuario->CorreoPendiente), $hash)
        ) {
            return redirect(
                env('FRONTEND_URL') .
                '/verificar-correo?estado=error&mensaje=' .
                urlencode('El enlace no es valido para este correo.')
            );
        }

        $usuario->Correo = $usuario->CorreoPendiente;
        $usuario->CorreoPendiente = null;
        $usuario->CorreoVerificadoEn = now();
        $usuario->save();

        return redirect(
            env('FRONTEND_URL') .
            '/verificar-correo?estado=exito&mensaje=' .
            urlencode('Correo verificado correctamente.')
        );
    }
}
