<?php 

namespace Controllers;

use Model\Alumno;
use MVC\Router;

class AlumnoController{
    public static function index (Router $router){
        
        $router->render("admin/alumnos");
    }
    public static function mostrar()
    {
        $alumnos = Alumno::all();
        echo json_encode([
            'entidad' => $alumnos
        ]);
    }
    public static function crear()
    {
        $alumno = new Alumno($_POST);
        $resultado = Alumno::where('numeroControl', $alumno->numeroControl);

        //Ya existe un maestro con ese numero
        if ($resultado) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ya existe un alumno con este numero de control'
            ];
            echo json_encode($respuesta);
            return;
        }
        //Se guarda el registro
        else {
            $resultado = $alumno->guardar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se inserto correctamente!'
            ];
            echo json_encode($respuesta);
        }
    }
    public static function actualizar()
    {
        $maestro = Alumno::where('id', $_POST['id']);

        if (!$maestro) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
            return;
        }

        $alumno = new Alumno($_POST);
        $resultado = $alumno->guardar();

        if ($resultado) {
            $resultado = $alumno->guardar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se actualizo correctamente!'
            ];
            echo json_encode($respuesta);
        }
    }
    public static function eliminar()
    {

        $alumno = new Alumno($_POST);

        $resultado = Alumno::where('numeroControl', $alumno->numeroControl);

        //Si existe un alumno con ese numero
        if ($resultado) {
            $resultado = $resultado->eliminar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se elimino correctamente!'
            ];
            echo json_encode($respuesta);
            return;
            //No existe un alumno con ese numero
        } else {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
        }
    }
}