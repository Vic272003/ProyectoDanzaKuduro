<?php
require_once 'Conexion.php';
/**
 * Clase Monitor 
 */
class Horario
{
    public static function verHorarioCodGrupo($codGrupo){
        $anioActual = date('Y');
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoHorario = $conectar->query("Select cod_grupo,nombre,dni_monitor,hora_inicio,hora_fin,dia from clases C, monitor M where M.dni=C.dni_monitor and cod_grupo='$codGrupo' and YEAR(dia)>='$anioActual';");
            if ($listadoHorario->rowCount() > 0) {
                $infoHorario = $listadoHorario->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $infoHorario = null;

            }
        } catch (Exception $ex) {
        };
        return $infoHorario;
    }
}