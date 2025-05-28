<?php

namespace Model;

class Maestro extends ActiveRecord{
    protected static $tabla = 'maestros';
    protected static $columnasDB = ['id', 'nombre','apellidos','correo'];

    public $id;
    public $nombre;
    public $apellidos;
    public $correo;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->correo = $args['correo'] ?? '';
    }
}