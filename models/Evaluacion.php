<?php

namespace Model;

use Exception;

class Evaluacion extends ActiveRecord
{
    protected static $tabla = 'evaluaciones';
    protected static $columnasDB = ['id', 'pregunta1', 'pregunta2', 'pregunta3', 'pregunta4', 'pregunta5', 'fecha', 'estado', 'idAlumno', 'idMaestro'];

    public $id;
    public $pregunta1;
    public $pregunta2;
    public $pregunta3;
    public $pregunta4;
    public $pregunta5;
    public $fecha;
    public $estado;
    public $idAlumno;
    public $idMaestro;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->pregunta1 = $args['pregunta1'] ?? 0;
        $this->pregunta2 = $args['pregunta2'] ?? 0;
        $this->pregunta3 = $args['pregunta3'] ?? 0;
        $this->pregunta4 = $args['pregunta4'] ?? 0;
        $this->pregunta5 = $args['pregunta5'] ?? 0;
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
        $this->estado = $args['estado'] ?? 0;
        $this->idAlumno = $args['idAlumno'] ?? null;
        $this->idMaestro = $args['idMaestro'] ?? null;
    }

    public static function evaluaciones()
    {
        $query = "SELECT 
            alumnos.nombre AS alumnoNombre, 
            alumnos.apellidos AS alumnoApellidos, 
            alumnos.id AS alumnoId, 
            maestros.nombre AS maestroNombre, 
            maestros.apellidos AS maestroApellidos, 
            maestros.id AS maestroId, 
            evaluaciones.id AS evaluacionId,
            evaluaciones.estado AS estado
        FROM 
            alumnos 
        JOIN 
            evaluaciones ON alumnos.id = evaluaciones.idAlumno 
        JOIN 
            maestros ON maestros.id = evaluaciones.idMaestro;";
        return self::consultarSQL($query);
    }

    public static function filtrarSemestreCarreraGrupo($semestre, $carrera, $grupo)
    {
        $query = "SELECT alumnos.carrera, alumnos.semestre, alumnos.grupo
        FROM alumnos
        JOIN evaluaciones ON alumnos.id = evaluaciones.idAlumno
        WHERE alumnos.carrera = '$carrera' AND alumnos.semestre = '$semestre' AND alumnos.grupo = '$grupo';";
        return self::consultarSQL($query);
    }

    public static function filtrarSemestreCarreraGrupoMaestro($semestre, $carrera, $grupo, $maestro)
    {
        $query = "SELECT alumnos.carrera, alumnos.semestre, alumnos.grupo
        FROM alumnos
        JOIN evaluaciones ON alumnos.id = evaluaciones.idAlumno
        WHERE alumnos.carrera = '$carrera' AND alumnos.semestre = '$semestre' AND alumnos.grupo = '$grupo' AND evaluaciones.idMaestro = $maestro;";
        return array_shift(self::consultarSQL($query));
    }

    public function asignar($idMaestro, $semestre, $carrera, $grupo)
    {
        $query = "
            INSERT INTO " . static::$tabla . " (pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, fecha, estado, idAlumno, idMaestro)
            SELECT $this->pregunta1, $this->pregunta2, $this->pregunta3, $this->pregunta4, $this->pregunta5, '$this->fecha', $this->estado, id, $idMaestro
            FROM alumnos 
            WHERE semestre = '$semestre' 
            AND carrera = '$carrera' 
            AND grupo = '$grupo';
        ";
        $resultado = self::$db->query($query);

        if ($resultado && self::$db->affected_rows > 0) {
            $this->id = self::$db->insert_id;
            return [
                'resultado' => $resultado,
                'id' => $this->id,
                'query' => $query
            ];
        } else {
            return [
                'resultado' => false,
                'mensaje' => 'No se encontraron alumnos para insertar',
                'query' => $query
            ];
        }
    }

    public function evaluacionesInsertadas($idMaestro, $carrera, $semestre, $grupo)
    {
        $query = "SELECT 
            alumnos.nombre AS alumnoNombre, 
            alumnos.apellidos AS alumnoApellidos, 
            alumnos.id AS alumnoId, 
            maestros.nombre AS maestroNombre, 
            maestros.apellidos AS maestroApellidos, 
            maestros.id AS maestroId, 
            evaluaciones.id AS evaluacionId,
            evaluaciones.estado AS estado
        FROM 
            alumnos 
        JOIN 
            evaluaciones ON alumnos.id = evaluaciones.idAlumno 
        JOIN 
            maestros ON maestros.id = evaluaciones.idMaestro 
        WHERE alumnos.carrera = '$carrera' AND alumnos.semestre = '$semestre' AND alumnos.grupo = '$grupo' AND maestros.id = $idMaestro;";
        return self::consultarSQL($query);
    }

    public function asignarr($idMaestro, $carrera, $semestre, $grupo){
        $query = "SELECT alumnos.carrera, alumnos.semestre, alumnos.grupo
        FROM alumnos
        JOIN evaluaciones ON alumnos.id = evaluaciones.idAlumno
        WHERE alumnos.carrera = '$carrera' AND alumnos.semestre = '$semestre' AND alumnos.grupo = '$grupo' AND evaluaciones.idMaestro = $idMaestro;";

        $resultado =  array_shift(self::consultarSQL($query));
        if(!empty($resultado)){
            ActiveRecord::enviarRespuesta('error', 'Este grupo ya se encuentra asignado a este maestro');
            return;
        }

    }

}
