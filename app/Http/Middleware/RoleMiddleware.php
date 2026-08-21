<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $usuario = $request->user();

        if (!$usuario) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'No autenticado.'
            ], 401);
        }

        $usuario->load('rol');

        if (!$usuario->rol) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'El usuario no tiene un rol asignado.'
            ], 403);
        }

        $rolUsuario = strtolower(trim($usuario->rol->nombre));

        $rolesPermitidos = array_map(
            fn ($rol) => strtolower(trim($rol)),
            $roles
        );

        if (!in_array($rolUsuario, $rolesPermitidos)) {
            return response()->json([
                'resultado' => 'error',
                'mensaje' => 'No tienes permisos para realizar esta acción.'
            ], 403);
        }

        return $next($request);
    }
}