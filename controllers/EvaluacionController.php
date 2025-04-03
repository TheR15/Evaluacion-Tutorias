<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Alumno;
use Model\Evaluacion;
use Model\Maestro;
use MVC\Router;

class EvaluacionController
{

    public static function index(Router $router)
    {
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }

        $evaluaciones = Evaluacion::evaluaciones();
        $tutorias = Evaluacion::tutorias();
        $router->render(
            'admin/index',
            [
                'evaluaciones' => $evaluaciones,
                'tutorias' => $tutorias
            ]
        );
    }
    public static function evaluaciones(Router $router)
    {
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }
        $router->render(  'admin/evaluaciones');
    }
    public static function mostrar()
    {
        $evaluaciones = Evaluacion::evaluaciones();
        $maestros = Maestro::all();
        $tutorias = Evaluacion::tutorias();
        echo json_encode([
            'entidad' => $evaluaciones,
            'maestros' => $maestros,
            'tutorias' => $tutorias
        ]);
    }
    public static function crear()
    {
        $semestre = $_POST['semestre'];
        $carrera = $_POST['carrera'];
        $grupo = $_POST['grupo'];
        $idMaestro = intval($_POST['maestro']);

        Evaluacion::asignar($idMaestro, $carrera, $semestre, $grupo);
    }
    public static function actualizar()
    {
        $evaluacion = new Evaluacion($_POST);
        $resultado = $evaluacion->guardar();
        if ($resultado) {
            ActiveRecord::enviarRespuesta('exito', 'La evaluacion se envio correctamente');
        }
    }
    public static function eliminar()
    {
        $evaluacion = new Evaluacion($_POST);
        $resultado = Evaluacion::where('id', $evaluacion->id);

        if ($resultado) {
            //Eliminar evaluacion
            $resultado = $resultado->eliminar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se elimino correctamente!'
            ];
            echo json_encode($respuesta);
            return;
        } else {
            ActiveRecord::enviarRespuesta('error', 'Hubo un error');
        }
    }
    public static function actualizarTutor()
    {
        $evaluacion = new Evaluacion($_POST);
        $evaluacion->idMaestro = intval($_POST['maestro']);

        //Comprueba si el tutor ya esta asignado a este grupo
        $resultado = $evaluacion->where('idMaestro', $evaluacion->idMaestro);
        if ($resultado) {
            ActiveRecord::enviarRespuesta('error', 'Este maestro ya se encuentra asignado a otro grupo');
            return;
        }
        //Actualizar el tutor
        $resultado = $evaluacion->actualizarNuevoTutor();
        if ($resultado) {
            ActiveRecord::enviarRespuesta('exito', 'Se actualizo correctamente');
            return;
        }
    }
    public static function eliminarEvaluaciones()
    {
        $evaluacion = new Evaluacion($_POST);
        //Compruebar que si exista el grupo
        $resultado = $evaluacion->where('tutorias', $evaluacion->tutorias);
        if ($resultado) {
            $resultado = $evaluacion->eliminarEvaluaciones();
            if ($resultado) {
                ActiveRecord::enviarRespuesta('success', 'Se elimino correctamente');
                return;
            }
        } else {
            ActiveRecord::enviarRespuesta('error', 'Ocurrio un error');
            return;
        }
    }
    public static function evaluacion(Router $router){
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }

        $id = $_SESSION['id'];
        $evaluacion = Evaluacion::where('idAlumno',$id);
        if($evaluacion){
            $maestro = Maestro::where('id', $evaluacion->idMaestro);
        }else{
            header('Location: /');
            return;
        }

        $router->render('/evaluacion/index', [
            'maestro' => $maestro
        ]);
    }
    public static function preguntas(Router $router){
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }

        $id = $_SESSION['id'];
        $evaluacion = Evaluacion::where('idAlumno',$id);
        if($evaluacion){
            $maestro = Maestro::where('id', $evaluacion->idMaestro);
        }else{
            header('Location: /');
            return;
        }

        $router->render('/evaluacion/preguntas', [
            'evaluacion' => $evaluacion
        ]);
    }

}
