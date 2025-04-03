<?php

namespace Model;

use Exception;

class Evaluacion extends ActiveRecord
{
    protected static $tabla = 'evaluaciones';
    protected static $columnasDB = ['id', 'pregunta1', 'pregunta2', 'pregunta3', 'pregunta4', 'pregunta5', 'fecha', 'estado', 'idAlumno', 'idMaestro', 'tutorias'];

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
    public $tutorias;

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
        $this->tutorias = $args['tutorias'] ?? '';
    }

    public static function evaluaciones()
    {
        $query = "SELECT 
            alumnos.nombre AS nombreAlumno, 
            alumnos.apellidos AS apellidosAlumno, 
            alumnos.id AS idAlumno, 
            maestros.nombre AS nombreMaestro, 
            maestros.apellidos AS apellidosMaestro, 
            maestros.id AS idMaestro, 
            evaluaciones.id AS id,
            evaluaciones.estado AS estado,
            evaluaciones.tutorias AS tutorias
        FROM 
            alumnos 
        JOIN 
            evaluaciones ON alumnos.id = evaluaciones.idAlumno 
        JOIN 
            maestros ON maestros.id = evaluaciones.idMaestro;";
        return self::consultarSQL($query);
    }

    public static function tutorias()
    {
        $query = "SELECT DISTINCT tutorias FROM evaluaciones;";
        return self::consultarSQL($query);
    }

    public static function datosTutores()
    {
        $query = "SELECT 
    maestros.id AS idMaestro, 
    maestros.nombre AS nombreMaestro,
    maestros.apellidos AS apellidosMaestro,
    evaluaciones.tutorias AS grupoTutorias,
    COUNT(evaluaciones.id) AS total_evaluaciones,
    SUM(CASE WHEN evaluaciones.estado = 0 THEN 1 ELSE 0 END) AS totalSinRealizar,
    SUM(CASE WHEN evaluaciones.estado = 1 THEN 1 ELSE 0 END) AS totalRealizadas,
    SUM(evaluaciones.pregunta1) AS totalPregunta1,
    SUM(evaluaciones.pregunta2) AS totalPregunta2,
    SUM(evaluaciones.pregunta3) AS totalPregunta3,
    SUM(evaluaciones.pregunta4) AS totalPregunta4,
    SUM(CASE WHEN evaluaciones.pregunta1 = 5 THEN 1 ELSE 0 END) AS totalOpcion5Pregunta1,
    SUM(CASE WHEN evaluaciones.pregunta1 = 4 THEN 1 ELSE 0 END) AS totalOpcion4Pregunta1,
    SUM(CASE WHEN evaluaciones.pregunta1 = 3 THEN 1 ELSE 0 END) AS totalOpcion3Pregunta1,
    SUM(CASE WHEN evaluaciones.pregunta1 = 2 THEN 1 ELSE 0 END) AS totalOpcion2Pregunta1,
    SUM(CASE WHEN evaluaciones.pregunta1 = 1 THEN 1 ELSE 0 END) AS totalOpcion1Pregunta1,
    SUM(CASE WHEN evaluaciones.pregunta2 = 5 THEN 1 ELSE 0 END) AS totalOpcion5Pregunta2,
    SUM(CASE WHEN evaluaciones.pregunta2 = 4 THEN 1 ELSE 0 END) AS totalOpcion4Pregunta2,
    SUM(CASE WHEN evaluaciones.pregunta2 = 3 THEN 1 ELSE 0 END) AS totalOpcion3Pregunta2,
    SUM(CASE WHEN evaluaciones.pregunta2 = 2 THEN 1 ELSE 0 END) AS totalOpcion2Pregunta2,
    SUM(CASE WHEN evaluaciones.pregunta2 = 1 THEN 1 ELSE 0 END) AS totalOpcion1Pregunta2,
    SUM(CASE WHEN evaluaciones.pregunta3 = 5 THEN 1 ELSE 0 END) AS totalOpcion5Pregunta3,
    SUM(CASE WHEN evaluaciones.pregunta3 = 4 THEN 1 ELSE 0 END) AS totalOpcion4Pregunta3,
    SUM(CASE WHEN evaluaciones.pregunta3 = 3 THEN 1 ELSE 0 END) AS totalOpcion3Pregunta3,
    SUM(CASE WHEN evaluaciones.pregunta3 = 2 THEN 1 ELSE 0 END) AS totalOpcion2Pregunta3,
    SUM(CASE WHEN evaluaciones.pregunta3 = 1 THEN 1 ELSE 0 END) AS totalOpcion1Pregunta3,
    SUM(CASE WHEN evaluaciones.pregunta4 = 5 THEN 1 ELSE 0 END) AS totalOpcion5Pregunta4,
    SUM(CASE WHEN evaluaciones.pregunta4 = 4 THEN 1 ELSE 0 END) AS totalOpcion4Pregunta4,
    SUM(CASE WHEN evaluaciones.pregunta4 = 3 THEN 1 ELSE 0 END) AS totalOpcion3Pregunta4,
    SUM(CASE WHEN evaluaciones.pregunta4 = 2 THEN 1 ELSE 0 END) AS totalOpcion2Pregunta4,
    SUM(CASE WHEN evaluaciones.pregunta4 = 1 THEN 1 ELSE 0 END) AS totalOpcion1Pregunta4
FROM 
    maestros
JOIN 
    evaluaciones ON maestros.id = evaluaciones.idMaestro
GROUP BY 
    maestros.id, maestros.nombre, maestros.apellidos, evaluaciones.tutorias
ORDER BY 
    total_evaluaciones DESC;";
        return self::consultarSQL($query);
    }

    public static function datosCarrera()
    {
        $query = "SELECT 
    alumnos.carrera,
    -- Total de alumnos por carrera
    SUM(evaluaciones.pregunta1) AS totalPregunta1,
    SUM(evaluaciones.pregunta2) AS totalPregunta2,
    SUM(evaluaciones.pregunta3) AS totalPregunta3,
    SUM(evaluaciones.pregunta4) AS totalPregunta4,
    COUNT(*) AS total_alumnos,
    SUM(CASE WHEN evaluaciones.estado = 1 THEN 1 ELSE 0 END) AS totalRealizadas,
    SUM(CASE WHEN evaluaciones.estado = 0 THEN 1 ELSE 0 END) AS NoRealizadas,
    
    -- Conteo por opción para cada pregunta (1-4)
    -- Pregunta 1
    SUM(CASE WHEN evaluaciones.pregunta1 = 5 THEN 1 ELSE 0 END) AS p1_op5,
    SUM(CASE WHEN evaluaciones.pregunta1 = 4 THEN 1 ELSE 0 END) AS p1_op4,
    SUM(CASE WHEN evaluaciones.pregunta1 = 3 THEN 1 ELSE 0 END) AS p1_op3,
    SUM(CASE WHEN evaluaciones.pregunta1 = 2 THEN 1 ELSE 0 END) AS p1_op2,
    SUM(CASE WHEN evaluaciones.pregunta1 = 1 THEN 1 ELSE 0 END) AS p1_op1,
    
    -- Pregunta 2
    SUM(CASE WHEN evaluaciones.pregunta2 = 5 THEN 1 ELSE 0 END) AS p2_op5,
    SUM(CASE WHEN evaluaciones.pregunta2 = 4 THEN 1 ELSE 0 END) AS p2_op4,
    SUM(CASE WHEN evaluaciones.pregunta2 = 3 THEN 1 ELSE 0 END) AS p2_op3,
    SUM(CASE WHEN evaluaciones.pregunta2 = 2 THEN 1 ELSE 0 END) AS p2_op2,
    SUM(CASE WHEN evaluaciones.pregunta2 = 1 THEN 1 ELSE 0 END) AS p2_op1,
    
    -- Preguntas 3 y 4 (mismo patrón)
    SUM(CASE WHEN evaluaciones.pregunta3 = 5 THEN 1 ELSE 0 END) AS p3_op5,
    SUM(CASE WHEN evaluaciones.pregunta3 = 4 THEN 1 ELSE 0 END) AS p3_op4,
    SUM(CASE WHEN evaluaciones.pregunta3 = 3 THEN 1 ELSE 0 END) AS p3_op3,
    SUM(CASE WHEN evaluaciones.pregunta3 = 2 THEN 1 ELSE 0 END) AS p3_op2,
    SUM(CASE WHEN evaluaciones.pregunta3 = 1 THEN 1 ELSE 0 END) AS p3_op1,
    
    SUM(CASE WHEN evaluaciones.pregunta4 = 5 THEN 1 ELSE 0 END) AS p4_op5,
    SUM(CASE WHEN evaluaciones.pregunta4 = 4 THEN 1 ELSE 0 END) AS p4_op4,
    SUM(CASE WHEN evaluaciones.pregunta4 = 3 THEN 1 ELSE 0 END) AS p4_op3,
    SUM(CASE WHEN evaluaciones.pregunta4 = 2 THEN 1 ELSE 0 END) AS p4_op2,
    SUM(CASE WHEN evaluaciones.pregunta4 = 1 THEN 1 ELSE 0 END) AS p4_op1
FROM 
    evaluaciones
JOIN 
    alumnos ON evaluaciones.idAlumno = alumnos.id
GROUP BY 
    alumnos.carrera;";
        return self::consultarSQL($query);
    }

    public static function datosGeneral()
    {
        $query = "SELECT 
    -- Totales generales (sin agrupar por carrera)
    COUNT(*) AS totalEvaluaciones,
    SUM(CASE WHEN evaluaciones.estado = 1 THEN 1 ELSE 0 END) AS totalRealizadas,
    SUM(CASE WHEN evaluaciones.estado = 0 THEN 1 ELSE 0 END) AS totalNoRealizadas,

    -- Suma de respuestas para todas las preguntas
    SUM(evaluaciones.pregunta1) AS totalPregunta1,
    SUM(evaluaciones.pregunta2) AS totalPregunta2,
    SUM(evaluaciones.pregunta3) AS totalPregunta3,
    SUM(evaluaciones.pregunta4) AS totalPregunta4,

    -- Conteo de opciones para cada pregunta (1-5)
    -- Pregunta 1
    SUM(CASE WHEN evaluaciones.pregunta1 = 5 THEN 1 ELSE 0 END) AS p1_op5,
    SUM(CASE WHEN evaluaciones.pregunta1 = 4 THEN 1 ELSE 0 END) AS p1_op4,
    SUM(CASE WHEN evaluaciones.pregunta1 = 3 THEN 1 ELSE 0 END) AS p1_op3,
    SUM(CASE WHEN evaluaciones.pregunta1 = 2 THEN 1 ELSE 0 END) AS p1_op2,
    SUM(CASE WHEN evaluaciones.pregunta1 = 1 THEN 1 ELSE 0 END) AS p1_op1,

    -- Pregunta 2 (mismo patrón)
    SUM(CASE WHEN evaluaciones.pregunta2 = 5 THEN 1 ELSE 0 END) AS p2_op5,
    SUM(CASE WHEN evaluaciones.pregunta2 = 4 THEN 1 ELSE 0 END) AS p2_op4,
    SUM(CASE WHEN evaluaciones.pregunta2 = 3 THEN 1 ELSE 0 END) AS p2_op3,
    SUM(CASE WHEN evaluaciones.pregunta2 = 2 THEN 1 ELSE 0 END) AS p2_op2,
    SUM(CASE WHEN evaluaciones.pregunta2 = 1 THEN 1 ELSE 0 END) AS p2_op1,

    -- Preguntas 3 y 4 (continuar patrón)
    SUM(CASE WHEN evaluaciones.pregunta3 = 5 THEN 1 ELSE 0 END) AS p3_op5,
    SUM(CASE WHEN evaluaciones.pregunta3 = 4 THEN 1 ELSE 0 END) AS p3_op4,
    SUM(CASE WHEN evaluaciones.pregunta3 = 3 THEN 1 ELSE 0 END) AS p3_op3,
    SUM(CASE WHEN evaluaciones.pregunta3 = 2 THEN 1 ELSE 0 END) AS p3_op2,
    SUM(CASE WHEN evaluaciones.pregunta3 = 1 THEN 1 ELSE 0 END) AS p3_op1,

    SUM(CASE WHEN evaluaciones.pregunta4 = 5 THEN 1 ELSE 0 END) AS p4_op5,
    SUM(CASE WHEN evaluaciones.pregunta4 = 4 THEN 1 ELSE 0 END) AS p4_op4,
    SUM(CASE WHEN evaluaciones.pregunta4 = 3 THEN 1 ELSE 0 END) AS p4_op3,
    SUM(CASE WHEN evaluaciones.pregunta4 = 2 THEN 1 ELSE 0 END) AS p4_op2,
    SUM(CASE WHEN evaluaciones.pregunta4 = 1 THEN 1 ELSE 0 END) AS p4_op1
FROM 
    evaluaciones
JOIN 
    alumnos ON evaluaciones.idAlumno = alumnos.id;";
        return self::consultarSQL($query);
    }

    public static function filtrarSemestreCarreraGrupo($semestre, $carrera, $grupo)
    {
        $query = "SELECT alumnos.carrera, alumnos.semestre, alumnos.grupo
                  FROM alumnos
                  JOIN evaluaciones ON alumnos.id = evaluaciones.idAlumno
                  WHERE alumnos.carrera = '$carrera' 
                  AND alumnos.semestre = '$semestre' 
                  AND alumnos.grupo = '$grupo';";

        $resultado = self::consultarSQL($query);

        // Verificar si el resultado está vacío
        if (empty($resultado)) {
            // Retornar un valor específico, por ejemplo, null o un mensaje
            return null; // o return "No se encontraron resultados";
        }

        // Retornar el resultado si no está vacío
        return $resultado;
    }

    public static function filtrarSemestreCarreraGrupoMaestro($semestre, $carrera, $grupo, $maestro)
    {
        $query = "SELECT alumnos.carrera, alumnos.semestre, alumnos.grupo
        FROM alumnos
        JOIN evaluaciones ON alumnos.id = evaluaciones.idAlumno
        WHERE alumnos.carrera = '$carrera' AND alumnos.semestre = '$semestre' AND alumnos.grupo = '$grupo' AND evaluaciones.idMaestro = $maestro;";
        return array_shift(self::consultarSQL($query));
    }

    public function guardarEvaluacion($idMaestro, $semestre, $carrera, $grupo, $nombreTutorias)
    {
        $query = "
            INSERT INTO " . static::$tabla . " (pregunta1, pregunta2, pregunta3, pregunta4, pregunta5, fecha, estado, idAlumno, idMaestro, tutorias)
            SELECT $this->pregunta1, $this->pregunta2, $this->pregunta3, $this->pregunta4, $this->pregunta5, '$this->fecha', $this->estado, id, $idMaestro, '$nombreTutorias'
            FROM alumnos 
            WHERE semestre = '$semestre' 
            AND carrera = '$carrera' 
            AND grupo = '$grupo';
        ";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function actualizarNuevoTutor()
    {
        $query = "
            UPDATE " . static::$tabla . " SET idMaestro = $this->idMaestro WHERE tutorias = '$this->tutorias';
        ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function evaluacionesInsertadas($idMaestro, $carrera, $semestre, $grupo)
    {
        $query = "SELECT 
            alumnos.nombre AS nombreAlumno, 
            alumnos.apellidos AS apellidosAlumno, 
            alumnos.id AS idAlumno, 
            maestros.nombre AS nombreMaestro, 
            maestros.apellidos AS apellidosMaestro, 
            maestros.id AS idMaestro, 
            evaluaciones.id AS id,
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

    public function eliminarEvaluaciones()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE tutorias = '$this->tutorias';";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function crearTutorias($carrera, $semestre, $grupo)
    {
        // Usamos una expresión regular para encontrar todas las letras mayúsculas
        preg_match_all('/[A-Z]/', $carrera, $matches);
        // $matches[0] contiene un array con todas las letras mayúsculas encontradas
        $carrera = implode('', $matches[0]);

        switch ($semestre) {
            case "Octavo Semestre":
                $semestre = "8";
                break;
            case "Septimo Semestre":
                $semestre = "7";
                break;
            case "Sexto Semestre":
                $semestre = "6";
                break;
            case "Quinto Semestre":
                $semestre = "5";
                break;
            case "Cuarto Semestre":
                $semestre = "4";
                break;
            case "Tercer Semestre":
                $semestre = "3";
                break;
            case "Segundo Semestre":
                $semestre = "2";
                break;
            case "Primer Semestre":
                $semestre = "1";
                break;
        }
        $tutorias = $carrera . '-' . $semestre . '-' . $grupo;

        return $tutorias;
    }

    public static function asignar($idMaestro, $carrera, $semestre, $grupo)
    {
        $evaluacion = new Evaluacion();
        // Filtrar por semestre, carrera, grupo y maestro
        $resultado = $evaluacion->filtrarSemestreCarreraGrupoMaestro($semestre, $carrera, $grupo, $idMaestro);
        if (!empty($resultado)) {
            ActiveRecord::enviarRespuesta('error', 'Este grupo ya se encuentra asignado a este maestro');
            return;
        }

        // Filtrar por maestro
        $resultado = $evaluacion->where('idMaestro', $idMaestro);
        if ($resultado) {
            ActiveRecord::enviarRespuesta('error', 'Este maestro ya se encuentra asignado a otro grupo');
            return;
        }

        // Filtrar por semestre, carrera y grupo
        $filtroSemestreCarreraGrupo = $evaluacion->filtrarSemestreCarreraGrupo($semestre, $carrera, $grupo);
        if (empty($filtroSemestreCarreraGrupo)) {
            $nombreTutorias = $evaluacion->crearTutorias($carrera, $semestre, $grupo);
            $resultado = $evaluacion->guardarEvaluacion($idMaestro, $semestre, $carrera, $grupo, $nombreTutorias);
            if ($resultado) {
                $evaluaciones = $evaluacion->evaluacionesInsertadas($idMaestro, $carrera, $semestre, $grupo);
                ActiveRecord::enviarRespuesta('exito', 'Se asignó correctamente', [
                    'id' => $resultado['id'],
                    'evaluaciones' => $evaluaciones
                ]);
            } else {
                ActiveRecord::enviarRespuesta('error', 'No se pudo guardar la evaluación', []);
            }
        } else {
            ActiveRecord::enviarRespuesta('error', 'Este grupo ya se encuetra asignado', $filtroSemestreCarreraGrupo);
        }
    }
}
