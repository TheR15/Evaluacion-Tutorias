<?php

namespace Controllers;

require '../vendor/autoload.php'; // Ajusta la ruta según la ubicación de tu archivo
use Model\Materia;
use MVC\Router;

class MateriaController
{
    public static function index(Router $router)
    {
        $router->render('admin/materias');
    }

    public static function mostrar()
    {
        $materias = Materia::all();
        echo json_encode([
            'entidad' => $materias
        ]);
    }
    public static function crear()
    {
        $materia = new Materia($_POST);
        $resultado = Materia::where('clave', $materia->clave);

        //Ya existe un materia con ese numero
        if ($resultado) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ya existe una materia con esta clave'
            ];
            echo json_encode($respuesta);
            return;
        }
        //Se guarda el registro
        else {
            $resultado = $materia->guardar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se inserto correctamente!',
                'query' => $resultado['query'],
            ];
            echo json_encode($respuesta);
        }
    }
    public static function actualizar()
    {
        $materia = Materia::where('id', $_POST['id']);

        if (!$materia) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
            return;
        }

        $materia = new Materia($_POST);
        $resultado = $materia->guardar();

        //Si existe un materia para editar
        if ($resultado) {
            $resultado = $materia->guardar();
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

        $materia = new Materia($_POST);

        $resultado = Materia::where('clave', $materia->clave);

        //Si existe un materia con ese numero
        if ($resultado) {
            $resultado = $resultado->eliminar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se elimino correctamente!'
            ];
            echo json_encode($respuesta);
            return;
            //No existe un materia con ese numero
        } else {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
        }
    }
}
