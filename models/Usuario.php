<?php 

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre','apellidos','email','tipo','password'];

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $tipo;
    public $password;
    public $foto;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->tipo = $args['tipo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->foto = $args['foto'] ?? '';
    }

    public function validarLogin()
    {
        if (!$this->email || !$this->password) {
            self::$alertas[] = 'Todos los campos son obligatorios';
            return self::$alertas;
        }
        if (!$this->email) {
            self::$alertas[] = 'El correo es obligatorio';
            return self::$alertas;
        }
        if (!$this->password) {
            self::$alertas[] = 'La contraseña es obligatoria';
            return self::$alertas;
        }
    }

}