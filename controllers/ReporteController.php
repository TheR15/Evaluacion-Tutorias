<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Email;
use Model\Evaluacion;
use Model\Maestro;
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
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4, 'descarga', 'Tutor');
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
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4, 'descarga', 'Carrera');
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
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4, 'descarga', 'Reporte');
    }
    public static function enviarReporte()
    {
        //Genera las graficas de cada pregunta
        $pregunta = 1;
        $rutaImagen1 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 2;
        $rutaImagen2 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 3;
        $rutaImagen3 = Reportes::generarGrafica($_POST, $pregunta);

        $pregunta = 4;
        $rutaImagen4 = Reportes::generarGrafica($_POST, $pregunta);

        //Generar PDF
        Reportes::generarPDF($_POST, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4, 'correo', 'Tutor');
        //Enviar correo

        $tutor = Maestro::find($_POST['idTutor']);

        if ($tutor) {
            $email = new Email($tutor['correo'], $tutor['nombre']);
            $email->enviarCorreo();
            echo json_encode([
                'estado' => 'success',
                'mensaje' => 'El reporte se ha enviado correctamente'
            ]);
        }
    }
}
