<?php

namespace Controllers;
use Model\Usuario;
use MVC\Router;

class UsuarioController
{
    public static function index(Router $router)
    {
        $router->render('admin/usuarios');
    }

    public static function mostrar()
    {
        $usuarios = Usuario::all();
        echo json_encode([
            'entidad' => $usuarios
        ]);
    }

    public static function crear()
    {
        $usuario = new Usuario($_POST);
        $resultado = Usuario::where('email', $usuario->email);
        //Ya existe un usuario con ese numero
        if ($resultado) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ya existe una usuario con este correo'
            ];
            echo json_encode($respuesta);
            return;
        }
        //Se guarda el registro
        else {
            $resultado = $usuario->guardar();
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
        $usuario = Usuario::where('id', $_POST['id']);

        if (!$usuario) {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
            return;
        }

        $usuario = new Usuario($_POST);
        $resultado = $usuario->guardar();

        //Si existe un usuario para editar
        if ($resultado) {
            $resultado = $usuario->guardar();
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

        $usuario = new Usuario($_POST);

        $resultado = Usuario::where('email', $usuario->email);

        //Si existe un usuario con ese numero
        if ($resultado) {
            $resultado = $resultado->eliminar();
            $respuesta = [
                'id' => $resultado['id'],
                'tipo' => 'exito',
                'mensaje' => 'Se elimino correctamente!'
            ];
            echo json_encode($respuesta);
            return;
            //No existe un usuario con ese numero
        } else {
            $respuesta = [
                'tipo' => 'error',
                'mensaje' => 'Ocurrio un error'
            ];
            echo json_encode($respuesta);
        }
    }
}
