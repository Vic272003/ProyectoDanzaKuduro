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
    public static function saberNombre($id){
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoTarifas = $conectar->query("Select nombre from tarifas where id = $id;");
            if ($listadoTarifas->rowCount() > 0) {
                $infoTarifa = $listadoTarifas->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoTarifa;
    }
    public static function sacarDescuento($id){
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoTarifas = $conectar->query("Select descuento from tarifas where id = $id;");
            if ($listadoTarifas->rowCount() > 0) {
                $infoTarifa = $listadoTarifas->fetch(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoTarifa;
    }
}
