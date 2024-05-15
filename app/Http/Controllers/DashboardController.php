<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
        $exAlumnos = User::role('Exalumno')->with('roles')->get();

        // Inicializar el conteo de usuarios por género y por modalidad por año
        $generoCount = [];
        $modalidadCountPorAño = [];
        $contratoCountPorAño = [];
        $jornadaCountPorAño = [];
        $salarioCount = [
            'Entre 2 - 4 Millones' => 0,
            'Entre 4 - 6 Millones' => 0,
            'Entre 6 - 10 Millones' => 0,
            'Más de 10 millones' => 0,
            'Sin especificar' => 0,
        ];
        $empleadoCountPorAño = [];

        // Contar la cantidad de usuarios por género y por modalidad por año
        foreach ($exAlumnos as $user) {
            // Contar la cantidad de usuarios por género
            $genero = $user->genero ?: 'Sin especificar'; // Si no hay género especificado, se asigna "Sin especificar"
            if (isset($generoCount[$genero])) {
                $generoCount[$genero]++;
            } else {
                $generoCount[$genero] = 1;
            }

            // Contar la cantidad de usuarios por modalidad por año
            $fechagrado = $user->fechagrado;
            if ($fechagrado) {
                $año = date('Y', strtotime($fechagrado)); // Obtener el año de graduación
                $modalidad = $user->modalidad;
                if (!isset($modalidadCountPorAño[$año])) {
                    $modalidadCountPorAño[$año] = ['Presencial' => 0, 'Remoto' => 0, 'Mixto' => 0];
                }
                // Incrementar el contador de la modalidad correspondiente
                if ($modalidad === 'Presencial') {
                    $modalidadCountPorAño[$año]['Presencial']++;
                } elseif ($modalidad === 'Remoto') {
                    $modalidadCountPorAño[$año]['Remoto']++;
                } elseif ($modalidad === 'Mixto') {
                    $modalidadCountPorAño[$año]['Mixto']++;
                }
            }

            if ($fechagrado) {
                $año = date('Y', strtotime($fechagrado)); // Obtener el año de graduación
                $contrato = $user->tipocontrato;
                if (!isset($contratoCountPorAño[$año])) {
                    $contratoCountPorAño[$año] = ['OPS' => 0, 'De planta' => 0, 'Por obra' => 0];
                }
                // Incrementar el contador de la modalidad correspondiente
                if ($contrato === 'OPS') {
                    $contratoCountPorAño[$año]['OPS']++;
                } elseif ($contrato === 'De planta') {
                    $contratoCountPorAño[$año]['De planta']++;
                } elseif ($contrato === 'Por obra') {
                    $contratoCountPorAño[$año]['Por obra']++;
                }
            }

            if ($fechagrado) {
                $año = date('Y', strtotime($fechagrado)); // Obtener el año de graduación
                $jornada = $user->tipojornada;
                if (!isset($jornadaCountPorAño[$año])) {
                    $jornadaCountPorAño[$año] = ['Completa' => 0, 'Media' => 0];
                }
                // Incrementar el contador de la modalidad correspondiente
                if ($jornada === 'Completa') {
                    $jornadaCountPorAño[$año]['Completa']++;
                } elseif ($jornada === 'Media') {
                    $jornadaCountPorAño[$año]['Media']++;
                }
            }

            // Contar la cantidad de usuarios por intervalo de salario
            $salario = $user->salario;
            switch ($salario) {
                case 'Entre 2 - 4 Millones':
                case 'Entre 4 - 6 Millones':
                case 'Entre 6 - 10 Millones':
                case 'Más de 10 millones':
                    $salarioCount[$salario]++;
                    break;
                default:
                    // Considerar cualquier otro valor como "Sin especificar"
                    $salarioCount['Sin especificar']++;
                    break;
            }

            // Contar la cantidad de usuarios por estado de empleado por año
            $empleado = $user->empleado;
            if ($empleado) {
                $año = date('Y', strtotime($user->fechagrado));
                if (!isset($empleadoCountPorAño[$año])) {
                    $empleadoCountPorAño[$año] = ['Empleado' => 0, 'Desempleado' => 0];
                }
                $empleadoCountPorAño[$año][$empleado]++;
            }
        }

        //dd($empleadoCountPorAño);

        return view('dashboard', ['exAlumnos' => $exAlumnos, 'generoCount' => $generoCount, 'modalidadCountPorAño' => $modalidadCountPorAño, 'salarioCount' => $salarioCount, 'empleadoCountPorAño' => $empleadoCountPorAño, 'contratoCountPorAño' => $contratoCountPorAño, 'jornadaCountPorAño' => $jornadaCountPorAño]);
    }
}
