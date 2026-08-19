<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use App\Models\rol;
use App\Models\Ambiente;
use App\Models\evaluacion;
use App\Models\Evidencia;
use App\Models\habitaciones;
use App\Models\historial;
use App\Models\ordenesdetrabajo;
use App\Models\reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InformacionRolController extends Controller
{
    public function informacionPorRol(Request $request)
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

        $rol = strtolower(trim($usuario->rol->Nombre));

        

        if ($rol === 'administrador') {

            return response()->json([
                'resultado' => 'ok',
                'rol' => 'Administrador',
                'usuario' => [
                    'IdUsuario' => $usuario->IdUsuario,
                    'Nombre' => $usuario->Nombre,
                    'Apellidos' => $usuario->Apellidos,
                    'Correo' => $usuario->Correo
                ],

                'informacion' => [

                    'usuarios' => usuario::with('rol')->get(),

                    'roles' => rol::all(),

                    'habitaciones' => habitaciones::all(),

                    'ambientes' => Ambiente::all(),

                    'reportes' => reporte::with([
                        'usuario',
                        'habitacion',
                        'ambiente'
                    ])->get(),

                    'ordenes' => ordenesdetrabajo::with([
                        'usuario',
                        'reporte',
                        'ambiente',
                        'habitacion'
                    ])->get(),

                    'evidencias' => Evidencia::all(),

                    'evaluaciones' => evaluacion::all(),

                    'historial' => historial::all()
                ]
            ], 200);
        }

        

        if ($rol === 'supervisor') {

            return response()->json([
                'resultado' => 'ok',
                'rol' => 'Supervisor',
                'usuario' => [
                    'IdUsuario' => $usuario->IdUsuario,
                    'Nombre' => $usuario->Nombre,
                    'Apellidos' => $usuario->Apellidos,
                    'Correo' => $usuario->Correo
                ],

                'informacion' => [

                    'habitaciones' => habitaciones::all(),

                    'ambientes' => Ambiente::all(),

                    'reportes' => reporte::with([
                        'usuario',
                        'habitacion',
                        'ambiente'
                    ])->get(),

                    'ordenes' => ordenesdetrabajo::with([
                        'usuario',
                        'reporte',
                        'ambiente',
                        'habitacion'
                    ])->get(),

                    'evidencias' => Evidencia::all(),

                    'evaluaciones' => evaluacion::all(),

                    'historial' => historial::all()
                ]
            ], 200);
        }

       

        if ($rol === 'operario') {

            
            $ordenes = ordenesdetrabajo::with([
                'reporte',
                'ambiente',
                'habitacion'
            ])
            ->where('usuario_IdUsuario', $usuario->IdUsuario)
            ->get();

            
            $idsOrdenes = $ordenes
                ->pluck('idOrden')
                ->filter()
                ->unique()
                ->toArray();

            
            $evidencias = Evidencia::whereIn(
                'ordenes_de_trabajo_idOrden',
                $idsOrdenes
            )->get();

            
            $idsHabitaciones = $ordenes
                ->pluck('habitaciones_No_habitacion')
                ->filter()
                ->unique()
                ->toArray();

            $habitacionesOperario = habitaciones::whereIn(
                'No_habitacion',
                $idsHabitaciones
            )->get();

            
            $historialOperario = historial::where(
                'usuario_IdUsuario',
                $usuario->IdUsuario
            )->get();

           
            $idsEvaluaciones = $evidencias
                ->pluck('evalucion_idEvalucion')
                ->filter()
                ->unique()
                ->toArray();

            $evaluacionesOperario = evaluacion::whereIn(
                'idEvaluacion',
                $idsEvaluaciones
            )->get();

            return response()->json([
                'resultado' => 'ok',
                'rol' => 'Operario',

                'usuario' => [
                    'IdUsuario' => $usuario->IdUsuario,
                    'Nombre' => $usuario->Nombre,
                    'Apellidos' => $usuario->Apellidos,
                    'Correo' => $usuario->Correo
                ],

                'informacion' => [
                    'ordenes_asignadas' => $ordenes,
                    'habitaciones' => $habitacionesOperario,
                    'evidencias' => $evidencias,
                    'evaluaciones' => $evaluacionesOperario,
                    'historial' => $historialOperario
                ]
            ], 200);
        }

        return response()->json([
            'resultado' => 'error',
            'mensaje' => 'El rol "' . $usuario->rol->Nombre . '" no está configurado.'
        ], 403);
    }
}