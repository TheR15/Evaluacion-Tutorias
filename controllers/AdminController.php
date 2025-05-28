<?php 

namespace Controllers;

use Model\ActiveRecord;
use Model\Alumno;
use Model\Evaluacion;
use Model\Maestro;
use MVC\Router;

class AdminController{
    public static function index (Router $router){
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }
        $router->render("admin/index",
        ['foto' => $_SESSION['foto']]);
    }
    public static function reestablecer (Router $router){
        session_start();
        if(!$_SESSION['id']){
            header('Location: /');
        }
        $router->render("admin/reestablecer");
    }
    public static function reestablecerAll(){
        $resultado = ActiveRecord::reestablecer();
        $resultado = [
            'tipo' => 'exito',
            'mensaje' => 'Se reestablecio correctamente!'
        ];
        echo json_encode($resultado);
    }
    public static function actualizarSemestre (Router $router){
        $router->render("admin/actualizar-semestre");
    }

    public static function actualizar(){
        $resultado = Alumno::actualizarSemestre();
    }
}