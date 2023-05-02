<?php
require_once 'Conexion.php';
/**
 * Clase Evento 
 */
class Inscrito
{
    public static function saberInscritosXDni($dni){
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoInscritos = $conectar->query("Select id_evento from inscrito where dni_cliente='$dni';");
            if ($listadoInscritos->rowCount() > 0) {
                $infoInscrito = $listadoInscritos->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoInscrito;
    }
    public static function compraEventoRelacion($idEvento,$dni,$planCliente,$precioEvento){
        $fechaActual=date('Y-m-d');
        $precio=$precioEvento-$precioEvento*$planCliente/100;
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoInscritos = $conectar->query("INSERT INTO inscrito (id_evento,dni_cliente,precio,fecha_pago) VALUES ('$idEvento','$dni','$precio','$fechaActual');");
            if ($listadoInscritos->rowCount() > 0) {
                $infoInscrito = $listadoInscritos->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoInscrito;
    }
}
