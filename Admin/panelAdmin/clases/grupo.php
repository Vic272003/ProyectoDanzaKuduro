<?php
require_once 'conexion.php';
/**
 * Clase cliente 
 */
class Grupo{
    
    /**
     * Lista los los grupos
     */
    public static function listarGrupos(){
        try {
            $conectar=new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoGrupos=$conectar->query("Select * from grupo;");
            if($listadoGrupos->rowCount()>0){
                $infoGrupos=$listadoGrupos->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
            
        };
        return $infoGrupos;
    }
    
}