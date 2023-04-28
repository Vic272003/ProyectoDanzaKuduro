<?php
require_once 'Conexion.php';
/**
 * Clase Evento 
 */
class Tarifa
{
    public static function listarTarifas(){
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoTarifas = $conectar->query("Select * from tarifas;");
            if ($listadoTarifas->rowCount() > 0) {
                $infoTarifa = $listadoTarifas->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoTarifa;
    }
}
