<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\AlumnoController;
use Controllers\AuthController;
use Controllers\EvaluacionController;
use Controllers\MaestroController;
use Controllers\MateriaController;
use Controllers\UsuarioController;
use MVC\Router;

$router = new Router();

//Autenticacion
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'login']);

//Panel principal del administrador
$router->get('/admin', [AdminController::class, 'index']);

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

//CRUD de materias
$router->get('/materias', [MateriaController::class, 'index']);
$router->get('/api/materias', [MateriaController::class, 'mostrar']);
$router->post('/api/materia', [MateriaController::class, 'crear']);
$router->post('/api/materia/actualizar', [MateriaController::class, 'actualizar']);
$router->post('/api/materia/eliminar', [MateriaController::class, 'eliminar']);

//CRUD de usuarios
$router->get('/usuarios', [UsuarioController::class, 'index']);
$router->get('/api/usuarios', [UsuarioController::class, 'mostrar']);
$router->post('/api/usuario', [UsuarioController::class, 'crear']);
$router->post('/api/usuario/actualizar', [UsuarioController::class, 'actualizar']);
$router->post('/api/usuario/eliminar', [UsuarioController::class, 'eliminar']);

//Evaluaciones
$router->get('/evaluaciones', [EvaluacionController::class, 'index']);
$router->get('/api/evaluaciones', [EvaluacionController::class, 'mostrar']);
$router->post('/api/evaluacion', [EvaluacionController::class, 'crear']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();