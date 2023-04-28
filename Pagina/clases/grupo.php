<?php
require_once 'Conexion.php';
/**
 * Clase Grupo
 */
class Grupo
{

    /**
     * Lista los los grupos
     */
    public static function listarGrupos()
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoGrupos = $conectar->query("Select * from grupo;");
            if ($listadoGrupos->rowCount() > 0) {
                $infoGrupos = $listadoGrupos->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoGrupos;
    }
    public static function obtenerNombreGrupo($codGrupo)
    {
        $grupo = false;
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeGrupo= $conectar->query("Select especialidad from grupo where codigo='$codGrupo';");
        if ($existeGrupo->rowCount() > 0) {
            $infoGrupo= $existeGrupo->fetch(PDO::FETCH_ASSOC);
            $grupo = $infoGrupo['especialidad'];
        }
        return $grupo;
    }
}
