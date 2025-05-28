<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\AlumnoController;
use Controllers\AuthController;
use Controllers\EvaluacionController;
use Controllers\MaestroController;
use Controllers\MateriaController;
use Controllers\ReporteController;
use Controllers\UsuarioController;
use Model\Evaluacion;
use MVC\Router;

$router = new Router();

//Autenticacion
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);


//Panel principal del administrador
$router->get('/admin', [EvaluacionController::class, 'index']);
$router->get('/reestablecer', [AdminController::class, 'reestablecer']);
$router->post('/api/semestre/actualizar', [AdminController::class, 'actualizar']);

//CRUD de maestros
$router->get('/maestros', [MaestroController::class, 'index']);
$router->get('/api/maestros', [MaestroController::class, 'mostrar']);
$router->post('/api/maestro', [MaestroController::class, 'crear']);
$router->post('/api/maestro/actualizar', [MaestroController::class, 'actualizar']);
$router->post('/api/maestro/eliminar', [MaestroController::class, 'eliminar']);

//CRUD de alumnos
$router->get('/alumnos', [AlumnoController::class, 'index']);
$router->get('/api/alumnos', [AlumnoController::class, 'mostrar']);
$router->post('/api/alumno', [AlumnoController::class, 'crear']);
$router->post('/api/alumno/actualizar', [AlumnoController::class, 'actualizar']);
$router->post('/api/alumno/eliminar', [AlumnoController::class, 'eliminar']);

//Evaluaciones
$router->get('/evaluacion', [EvaluacionController::class, 'evaluacion']);
$router->get('/preguntas', [EvaluacionController::class, 'preguntas']);
$router->get('/evaluaciones', [EvaluacionController::class, 'evaluaciones']);
$router->get('/api/evaluaciones', [EvaluacionController::class, 'mostrar']);
$router->post('/api/evaluacion', [EvaluacionController::class, 'crear']);
$router->post('/api/evaluacion/actualizar', [EvaluacionController::class, 'actualizar']);
$router->post('/api/evaluacion/actualizarTutor', [EvaluacionController::class, 'actualizarTutor']);
$router->post('/api/evaluacion/eliminar', [EvaluacionController::class, 'eliminar']);
$router->post('/api/evaluacion/eliminarEvaluaciones', [EvaluacionController::class, 'eliminarEvaluaciones']);

//Estadisiticas
$router->get('/reporteTutor', [ReporteController::class, 'tutor']);
$router->get('/api/tutores', [ReporteController::class, 'obtenerDatosTutores']);
$router->get('/reporteCarrera', [ReporteController::class, 'carrera']);
$router->get('/api/carrera', [ReporteController::class, 'obtenerDatosCarrera']);
$router->get('/reporteGeneral', [ReporteController::class, 'general']);
$router->get('/api/general', [ReporteController::class, 'obtenerDatosGeneral']);

//Reportes
$router->post('/api/reporte/tutor', [ReporteController::class, 'generarReporteTutor']);
$router->post('/api/reporte/carrera', [ReporteController::class, 'generarReporteCarrera']);
$router->post('/api/reporte/general', [ReporteController::class, 'generarReporteGeneral']);
$router->post('/api/enviarReporte', [ReporteController::class, 'enviarReporte']);

//Eliminar registros
$router->get('/api/alumnos/eliminar', [AlumnoController::class, 'eliminarAlumnos']);
$router->get('/api/maestros/eliminar', [MaestroController::class, 'eliminarMaestros']);
$router->get('/api/evaluaciones/eliminar', [EvaluacionController::class, 'eliminarEvaluacionesAll']);
$router->get('/api/reestablecer', [AdminController::class, 'reestablecerAll']);
//Actualizar semestre


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();