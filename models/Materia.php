<?php 

namespace Model;

use Model\ActiveRecord;

class Materia extends ActiveRecord{
    protected static $tabla = 'materias';
    protected static $columnasDB = ['id', 'nombre','clave', 'semestre'];

    public $id;
    public $nombre;
    public $clave;
    public $semestre;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->clave = $args['clave'] ?? '';
        $this->semestre = $args['semestre'] ?? '';
    }
}