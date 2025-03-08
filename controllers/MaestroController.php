<?php

namespace Controllers;

require '../vendor/autoload.php'; // Ajusta la ruta según la ubicación de tu archivo
use Model\Maestro;
use MVC\Router;

class MaestroController
{
    public static function index(Router $router)
    {
        $router->render('admin/maestros');
    }

    public static function mostrar()
    {
        $maestros = Maestro::all();
        echo json_encode([
            'entidad' => $maestros
        ]);
    }
    public static function crear()
    {
        $maestro = new Maestro($_POST);
        $resultado = Maestro::where('numero', $maestro->numero);

        //Ya existe un maestro con ese numero
        if ($resultado) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ya existe un maestro con este numero'
            ];
            echo json_encode($respuesta);
            return;
        }
        //Se guarda el registro
        else {
            $resultado = $maestro->guardar();
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
        $maestro = Maestro::where('id', $_POST['id']);

        if (!$maestro) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
            return;
        }

        $maestro = new Maestro($_POST);
        $resultado = $maestro->guardar();

        //Si existe un maestro para editar
        if ($resultado) {
            $resultado = $maestro->guardar();
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

        $maestro = new Maestro($_POST);
        $resultado = Maestro::where('numero', $maestro->numero);
        
        //Si existe un maestro con ese numero
        if ($resultado) {
            $resultado = $resultado->eliminar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se elimino correctamente!'
            ];
            echo json_encode($respuesta);
            return;
            //No existe un maestro con ese numero
        } else {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
        }
    }
}
