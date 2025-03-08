<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Evaluacion;
use Model\Maestro;
use MVC\Router;

class EvaluacionController
{
    public static function index(Router $router)
    {
        $router->render('admin/evaluaciones');
    }

    public static function mostrar()
    {
        $evaluaciones = Evaluacion::evaluaciones();
        $maestros = Maestro::all();
        echo json_encode([
            'entidad' => $evaluaciones,
            'maestros' => $maestros
        ]);
    }

    public static function crear()
    {
        $semestre = $_POST['semestre'];
        $carrera = $_POST['carrera'];
        $grupo = $_POST['grupo'];
        $maestro = intval($_POST['maestro']);
        $evaluacion = new Evaluacion();



        // Filtrar por semestre, carrera, grupo y maestro
        $resultado = $evaluacion->filtrarSemestreCarreraGrupoMaestro($semestre, $carrera, $grupo, $maestro);
        if (!empty($resultado)) {
            ActiveRecord::enviarRespuesta('error', 'Este grupo ya se encuentra asignado a este maestro');
            return;
        }

        // Filtrar por semestre, carrera y grupo
        $filtroSemestreCarreraGrupo = $evaluacion->filtrarSemestreCarreraGrupo($semestre, $carrera, $grupo);
        if (!empty($filtroSemestreCarreraGrupo['resultado'])) {
            ActiveRecord::enviarRespuesta('error', 'Este grupo ya se encuentra asignado');
            return;
        }

        // Filtrar por maestro
        $resultado = $evaluacion->where('idMaestro', $maestro);
        if ($resultado) {
            ActiveRecord::enviarRespuesta('error', 'Este maestro ya se encuentra asignado a otro grupo');
            return;
        }

        if ($filtroSemestreCarreraGrupo === []) {
            $resultado = $evaluacion->asignar($maestro, $semestre, $carrera, $grupo);
            if ($resultado['resultado']) {
                $evaluaciones = $evaluacion->evaluacionesInsertadas($maestro, $carrera, $semestre, $grupo);
                ActiveRecord::enviarRespuesta('exito', 'Se asigno correctamente', [
                    'id' => $resultado['id'],
                    'evaluaciones' => $evaluaciones,
                    'filtro' => $filtroSemestreCarreraGrupo
                ]);
            } else {
                ActiveRecord::enviarRespuesta('error', $resultado['mensaje']);
            }
        } else {
            ActiveRecord::enviarRespuesta('error', 'No se encuentran alumnos de este grupo', $filtroSemestreCarreraGrupo);
        }
    }

}
