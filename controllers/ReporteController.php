<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Evaluacion;
use Model\Reportes;
use MVC\Router;

class ReporteController
{
    public static function obtenerDatosTutores()
    {
        $tutores = Evaluacion::datosTutores();
        echo json_encode([
            'tutores' => $tutores
        ]);
    }

    public static function obtenerDatosCarrera()
    {
        $carrera = Evaluacion::datosCarrera();
        echo json_encode([
            'carrera' => $carrera
        ]);
    }
    public static function obtenerDatosGeneral()
    {
        $general = Evaluacion::datosGeneral();
        echo json_encode([
            'general' => $general
        ]);
    }

    public static function tutor(Router $router)
    {
        session_start();
        if (!$_SESSION['id']) {
            header('Location: /');
        }
        $router->render('admin/reporte/tutor');
    }
    public static function carrera(Router $router)
    {
        session_start();
        if (!$_SESSION['id']) {
            header('Location: /');
        }
        $router->render('admin/reporte/carrera');
    }
    public static function general(Router $router)
    {
        session_start();
        if (!$_SESSION['id']) {
            header('Location: /');
        }
        $router->render('admin/reporte/general');
    }

    public static function generarReporteTutor()
    {
        $pregunta = 1;
        $rutaImagen1 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 2;
        $rutaImagen2 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 3;
        $rutaImagen3 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 4;
        $rutaImagen4 = Reportes::generarGrafica($_POST, $pregunta);
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4);
    }

    public static function generarReporteCarrera()
    {
        $pregunta = 1;
        $rutaImagen1 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 2;
        $rutaImagen2 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 3;
        $rutaImagen3 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 4;
        $rutaImagen4 = Reportes::generarGrafica($_POST, $pregunta);
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4);
    }

    public static function generarReporteGeneral()
    {
        $pregunta = 1;
        $rutaImagen1 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 2;
        $rutaImagen2 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 3;
        $rutaImagen3 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 4;
        $rutaImagen4 = Reportes::generarGrafica($_POST, $pregunta);
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4);
    }
}
