<?php

namespace Model;

class Alumno extends ActiveRecord
{
    protected static $tabla = 'alumnos';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'numeroControl', 'correo', 'password', 'semestre', 'carrera', 'grupo'];

    public $id;
    public $nombre;
    public $apellidos;
    public $numeroControl;
    public $correo;
    public $password;
    public $semestre;
    public $carrera;
    public $grupo;



    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->numeroControl = $args['numeroControl'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->semestre = $args['semestre'] ?? '';
        $this->carrera = $args['carrera'] ?? '';
        $this->grupo = $args['grupo'] ?? '';
    }
}
