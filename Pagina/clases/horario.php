<?php
require_once 'conexion.php';
/**
 * Clase Monitor 
 */
class Horario
{
    public static function verHorarioCodGrupo($codGrupo)
    {
        $anioActual = date('Y');
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoHorario = $conectar->query("Select cod_grupo,nombre,dni_monitor,hora_inicio,hora_fin,dia from clases C, monitor M where M.dni=C.dni_monitor and cod_grupo='$codGrupo' and YEAR(dia)>='$anioActual';");
            if ($listadoHorario->rowCount() > 0) {
                $infoHorario = $listadoHorario->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $infoHorario = null;
            }
        } catch (Exception $ex) {
        };
        return $infoHorario;
    }
    public static function verHorarioCodGrupoYMonitor($dniMonitor)
    {
        $anioActual = date('m');
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoHorario = $conectar->query("Select cod_grupo,dni_monitor,nombre,hora_inicio,hora_fin,dia from clases C, monitor M where M.dni=C.dni_monitor and C.dni_monitor='$dniMonitor' and MONTH(dia)>='$anioActual';");
            if ($listadoHorario->rowCount() > 0) {
                $infoHorario = $listadoHorario->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $infoHorario = null;
            }
        } catch (Exception $ex) {
        };
        return $infoHorario;
    }
    public static function crearClase($fecha, $horaInicio, $horaFin, $especialidad, $dniMonitor)
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $existeClase = $conectar->query("Select * from clases  where dia='$fecha' and hora_inicio='$horaInicio' and hora_fin='$horaFin';");
            if ($existeClase->rowCount() == 0) {
                $crearClase = $conectar->prepare("Insert into  clases  (cod_grupo,dni_monitor,hora_inicio,hora_fin,dia) values(:cod_grupo,:dni_monitor,:hora_inicio,:hora_fin,:dia)");
                $crearClase->bindParam(":cod_grupo", $especialidad);
                $crearClase->bindParam(":dni_monitor", $dniMonitor);
                $crearClase->bindParam(":hora_inicio", $horaInicio);
                $crearClase->bindParam(":hora_fin", $horaFin);
                $crearClase->bindParam(":dia", $fecha);
                $crearClase->execute();
            } else {
                $infoHorario = null;
            }
        } catch (Exception $ex) {
        };
        return $infoHorario;
    }
    public static function actualizarClase($dniMonitor, $dia, $horaInicio, $horaFin)
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $existeClase = $conectar->query("Select * from clases  where dia='$dia' and hora_inicio='$horaInicio' and hora_fin='$horaFin';");
            if ($existeClase->rowCount() == 0) {
                $sql = "UPDATE clases SET hora_inicio='$horaInicio',hora_fin='$horaFin' WHERE dni_monitor='$dniMonitor' and dia='$dia'";
            $actCliente= $conectar->query($sql);
                
                $resultado=true;
            } else {
                $resultado = null;
            }
        } catch (Exception $ex) {
        };
        
        return $resultado;
    }
}
