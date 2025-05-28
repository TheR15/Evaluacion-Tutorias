<?php 

namespace Controllers;

use Model\Alumno;
use Model\Email;
use MVC\Router;

class AlumnoController{
    public static function index (Router $router){
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }
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
        if ($resultado) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ya existe un alumno con este numero de control'
            ];
            echo json_encode($respuesta);
            return;
        }
        
        else {
            $resultado = $alumno->guardar();
            //Enviamos el correo al alumno
            $email = new Email($alumno->correo, $alumno->nombre);
            $email->correoRegistro($alumno->password);

            $respuesta = [
                'id' => $resultado['id'],
                'password'=> $alumno->password,
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

    public static function eliminarAlumnos(){
        $alumnos = new Alumno();
        $resultado = $alumnos->eliminarAll();
        if($resultado){
            $respuesta = [
                'tipo' => 'exito',
                'mensaje' => 'Se eliminaron todos los alumnos'
            ];
            echo json_encode($respuesta);
        }
    }

    public static function evaluacion(Router $router){
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }
        $router->render("/evaluacion/index");
    }
}