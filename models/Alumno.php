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

    public static function actualizarSemestre()
    {
        $query = "UPDATE alumnos
SET semestre = CASE
    WHEN semestre = 'Egresado' THEN 'Egresado'  -- No cambia nada
    WHEN semestre = '8' OR semestre = 8 THEN 'Egresado'  -- Cambia 8 a Egresado
    ELSE CAST(semestre AS UNSIGNED) + 1  -- Suma 1 al resto
END;
";

        $resultado = self::$db->query($query);
    }
}
