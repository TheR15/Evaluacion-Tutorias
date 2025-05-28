<?php
namespace Model;

use Exception;

class ActiveRecord {

    // Base de datos
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    protected static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);
        if ($resultado) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Error en la consulta: " . self::$db->error);
        }
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Registros - CRUD
    public function guardar() {
        return !is_null($this->id) ? $this->actualizar() : $this->crear();
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        return self::consultarSQL($query);
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    // crea un nuevo registro
    public function crear() {
        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO " . static::$tabla . " (" . join(', ', array_keys($atributos)) . ") VALUES ('" . join("', '", array_values($atributos)) . "')";
        $resultado = self::$db->query($query);
        return [
            'resultado' => $resultado,
            'id' => self::$db->insert_id,
            'query' => $query
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla ." SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function where($columna, $dato) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . $columna . " = '${dato}'";
        $resultado = self::consultarSQL($query);
        return !empty($resultado) ? new static($resultado[0]) : null;
    }

    public function eliminarAll(){
        $query = "DELETE FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function reestablecer(){
        $queryAlumnos = "DELETE FROM alumnos";
        $queryMaestros = "DELETE FROM maestros";
        $resultadoAlumnos = self::$db->query($queryAlumnos);
        $resultadoMaestros = self::$db->query($queryMaestros);

        if($resultadoAlumnos && $resultadoMaestros){
            return true;
        }
    }

    public static function enviarRespuesta($tipo, $mensaje, $datosAdicionales = [])
    {
        $respuesta = array_merge([
            'tipo' => $tipo,
            'mensaje' => $mensaje
        ], $datosAdicionales);

        echo json_encode($respuesta);
    }
}