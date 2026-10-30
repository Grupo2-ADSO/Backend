<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Ambiente;
use App\Models\Evaluacion;
use App\Models\Evidencia;
use App\Models\Habitaciones;
use App\Models\Historial;
use App\Models\OrdenesDeTrabajo;
use App\Models\Reporte;
use Illuminate\Http\Request;

class InformacionRolController extends Controller
{
    public function informacionPorRol(Request $request)
    {
        
        $usuario = $request->user();

        
        $usuario->load('rol');

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

                    'usuarios' => Usuario::with('rol')->get(),

                    'roles' => Rol::all(),

                    'habitaciones' => Habitaciones::all(),

                    'ambientes' => Ambiente::all(),

                    'reportes' => Reporte::with([
                        'usuario',
                        'habitacion',
                        'ambiente'
                    ])->get(),

                    'ordenes' => OrdenesDeTrabajo::with([
                        'usuario',
                        'reporte',
                        'ambiente',
                        'habitacion'
                    ])->get(),

                    'evidencias' => Evidencia::all(),

                    'evaluaciones' => Evaluacion::all(),

                    'historial' => Historial::all()
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

                    'habitaciones' => Habitaciones::all(),

                    'ambientes' => Ambiente::all(),

                    'reportes' => Reporte::with([
                        'usuario',
                        'habitacion',
                        'ambiente'
                    ])->get(),

                    'ordenes' => OrdenesDeTrabajo::with([
                        'usuario',
                        'reporte',
                        'ambiente',
                        'habitacion'
                    ])->get(),

                    'evidencias' => Evidencia::all(),

                    'evaluaciones' => Evaluacion::all(),

                    'historial' => Historial::all()
                ]
            ], 200);
        }

       
        if ($rol === 'operario') {

            $ordenes = OrdenesDeTrabajo::with([
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

            $habitacionesOperario = Habitaciones::whereIn(
                'No_habitacion',
                $idsHabitaciones
            )->get();

            $historialOperario = Historial::where(
                'usuario_IdUsuario',
                $usuario->IdUsuario
            )->get();

            $idsEvaluaciones = $evidencias
                ->pluck('evalucion_idEvalucion')
                ->filter()
                ->unique()
                ->toArray();

            $evaluacionesOperario = Evaluacion::whereIn(
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
