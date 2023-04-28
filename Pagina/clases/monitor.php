<?php
require_once 'Conexion.php';
/**
 * Clase Monitor 
 */
class Monitor
{
    private $dni;
    public function __construct($dni)
    {

        $this->dni = $dni;
    }
    /**
     * Lista los monitores activos
     */
    public static function listadoMonitores()
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoMonitores = $conectar->query("Select dni,nombre,apellidos,especialidad from monitor where baja='no' ;");
            if ($listadoMonitores->rowCount() > 0) {
                $infoMonitor = $listadoMonitores->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoMonitor;
    }
    /**
     * Lista los monitores que están dados de baja
     */
    public static function listadoMonitoresBaja()
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoMonitores = $conectar->query("Select dni,nombre,apellidos,especialidad from monitor where baja='si' ;");
            if ($listadoMonitores->rowCount() > 0) {
                $infoMonitor = $listadoMonitores->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoMonitor;
    }
    /**
     * Actualiza los datos dni, nombre, apellidos y contraseña del monitor
     */
    public static function actualizarMonitor($dni, $nombre, $apellidos,$password)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
            $resultado = "La conexion no la hace";
        }
        $existeMonitor = $conectar->query("Select nombre from monitor  where dni='$dni';");
        if ($existeMonitor->rowCount() > 0) {
            if(empty($password)){
                $sql_contrasena = "";
            }else{
                $sql_contrasena = ",contrasenia='$password'";
            }
            $sql = "UPDATE monitor
                SET nombre='$nombre',apellidos='$apellidos'$sql_contrasena WHERE dni='$dni'";
            $actMonitor = $conectar->query($sql);

            $resultado = true;
        } else {
            $resultado = false;
        }

        return $resultado;
    }
    /**
     * Lista los datos dni, nombre y apellidos pasándole el dni
     */
    public static function listaMonitor($dni)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeMonitor = $conectar->query("Select dni,nombre,apellidos from monitor  where dni='$dni';");
        if ($existeMonitor->rowCount() > 0) {
            $infoMonitor = $existeMonitor->fetch(PDO::FETCH_ASSOC);
        }
        return $infoMonitor;
    }
    /**
     * Da de baja el monitor pasándole el dni
     */
    public static function eliminarMonitor($dni)
    {
        $resultado = false;
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeMonitor = $conectar->query("Select nombre from monitor  where dni='$dni';");
        if ($existeMonitor->rowCount() > 0) {
            $elimMonitor = $conectar->query("UPDATE monitor SET baja='si' WHERE dni='$dni'");
            $resultado = true;
        }
        return $resultado;
    }
    /**
     * Da de alta el monitor pasándole por parámetro el dni
     */
    public static function darAltaMonitor($dni)
    {
        $resultado = false;
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeMonitor = $conectar->query("Select nombre from monitor  where dni='$dni';");
        if ($existeMonitor->rowCount() > 0) {
            $darAlta = $conectar->query("UPDATE monitor SET baja='no' WHERE dni='$dni'");
            $resultado = true;
        }
        return $resultado;
    }
    /**
     * Crea un monitor
     */
    public static function crearMonitor($dni, $nombre, $apellidos, $contrasenia, $dniGestor,$especialidad)
    {
        $fechaAlta = date('Y-m-d');
        $baja = "no";
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeMonitor = $conectar->query("Select nombre from monitor  where dni='$dni';");
        if ($existeMonitor->rowCount() == 0) {
            $crearMonitor = $conectar->prepare("Insert into  monitor  (dni,dni_gestor,nombre,apellidos,contrasenia,baja,fecha_alta,especialidad) values(:dni,:gestor,:nombre,:apellidos,:contrasenia,:baja,:fecha_alta,:especialidad)");
            $crearMonitor->bindParam(":dni", $dni);
            $crearMonitor->bindParam(":nombre", $nombre);
            $crearMonitor->bindParam(":gestor", $dniGestor);
            $crearMonitor->bindParam(":apellidos", $apellidos);
            $crearMonitor->bindParam(":contrasenia", $contrasenia);
            $crearMonitor->bindParam(":baja", $baja);
            $crearMonitor->bindParam(":especialidad", $especialidad);
            $crearMonitor->bindParam(":fecha_alta", $fechaAlta);
            $crearMonitor->execute();
        } else {
            $crearMonitor = false;
        }
        return $crearMonitor;
    }
    public static function comprobarMonitor($dni, $password)
    {
        $datosCorrectos = false;
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $existeMonitor = $conectar->query("Select contrasenia from monitor where dni='$dni' and baja='no';");
            if ($existeMonitor->rowCount() > 0) {
                $infoMonitores = $existeMonitor->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $infoMonitores['contrasenia'])) {
                    $datosCorrectos = true;
                }
            }else{
                $datosCorrectos = false;
            }
        } catch (Exception $ex) {
        };
        return $datosCorrectos;
    }
    public static function obtenerEspecialidad($dni){
        $grupo=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeMonitor=$conectar->query("Select especialidad from monitor  where dni='$dni';");
        if($existeMonitor->rowCount()>0){
            $infoMonitor=$existeMonitor->fetch(PDO::FETCH_ASSOC);
            $grupo=$infoMonitor['especialidad'];
        }
        return $grupo;
    }
}
