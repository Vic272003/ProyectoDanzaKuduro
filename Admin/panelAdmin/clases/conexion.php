<?php 
/**
 * Clase Conexión de PDO
 */
    class Conexion extends PDO{
        private $dsn="mysql:host=localhost:33066;dbname=danzakuduro";
        private $nombre="root";
        public function __construct(){
            try{
                parent::__construct($this->dsn, $this->nombre);
            } catch (Exception $ex) {
                echo $ex;
            }
            
        }
        function getDsn(){
            return $this->dsn;
        }
        function getNombre(){
            return $this->nombre;
        }
    }