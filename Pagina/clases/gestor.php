<?php
require_once 'Conexion.php';
/**
 * Clase gestor 
 */
class Gestor
{
    /**
     * Comprueba el gestor pasándole la contraseña
     */
    public static function comprobarGestor($dni, $password)
    {
        $datosCorrectos = false;
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $existeGestor = $conectar->query("Select contrasenia from gestor where dni='$dni' and baja='no';");
            if ($existeGestor->rowCount() > 0) {
                $infoClientes = $existeGestor->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $infoClientes['contrasenia'])) {
                    $datosCorrectos = true;
                }
            }else{
                $datosCorrectos = false;
            }
        } catch (Exception $ex) {
        };
        return $datosCorrectos;
    }
    /**
     * Lista los gestores activos
     */
    public static function listadoGestores()
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoGestores = $conectar->query("Select dni,nombre,apellidos from gestor where baja='no'  and dni!='00000000A' ;");
            if ($listadoGestores->rowCount() > 0) {
                $infoGestor = $listadoGestores->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoGestor;
    }
    /**
     * Lista los gestores que están dados de baja
     */
    public static function listadoGestoresBaja()
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoGestores = $conectar->query("Select dni,nombre,apellidos from gestor where baja='si' ;");
            if ($listadoGestores->rowCount() > 0) {
                $infoGestor = $listadoGestores->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoGestor;
    }
    /**
     * Actualiza los datos dni, nombre, apellidos, y contraseña del gestor
     */
    public static function actualizarGestor($dni, $nombre, $apellidos, $password)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
            $resultado = "La conexion no la hace";
        }
        $existeGestor = $conectar->query("Select nombre from gestor  where dni='$dni';");
        if ($existeGestor->rowCount() > 0) {
            if(empty($password)){
                $sql_contrasena = "";
            }else{
                $sql_contrasena = ",contrasenia='$password'";
            }
            $sql = "UPDATE gestor
                SET nombre='$nombre',apellidos='$apellidos'$sql_contrasena WHERE dni='$dni'";
            $actGestor = $conectar->query($sql);
            $resultado = true;
        } else {
            $resultado = false;
        }

        return $resultado;
    }
    /**
     * Lista los datos dni, nombre y apellidos pasándole el dni
     */
    public static function listaGestor($dni)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeGestor = $conectar->query("Select dni,nombre,apellidos from gestor  where dni='$dni';");
        if ($existeGestor->rowCount() > 0) {
            $infoGestor = $existeGestor->fetch(PDO::FETCH_ASSOC);
        }
        return $infoGestor;
    }
    /**
     * Da de baja el gestor pasándole el dni
     */
    public static function eliminarGestor($dni)
    {
        $resultado = false;
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeGestor = $conectar->query("Select nombre from gestor  where dni='$dni';");
        if ($existeGestor->rowCount() > 0) {
            $elimGestor = $conectar->query("UPDATE gestor SET baja='si' WHERE  dni='$dni'");
            $resultado = true;
        }
        return $resultado;
    }
    /**
     * Da de alta el cliente pasándole por parámetro el dni
     */
    public static function darAltaGestor($dni)
    {
        $resultado = false;
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeGestor = $conectar->query("Select nombre from gestor  where dni='$dni';");
        if ($existeGestor->rowCount() > 0) {
            $darAlta = $conectar->query("UPDATE gestor SET baja='no' WHERE dni='$dni'");
            $resultado = true;
        }
        return $resultado;
    }
    /**
     * Crea un gestor pasándole por parámetro el dni, nombre, apellidos, contraseña
     */
    public static function crearGestor($dni, $nombre, $apellidos, $contrasenia)
    {
        $baja = "no";
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeGestor = $conectar->query("Select nombre from gestor  where dni='$dni';");
        if ($existeGestor->rowCount() == 0) {
            $crearGestor = $conectar->prepare("Insert into  gestor  (dni,nombre,apellidos,contrasenia,baja) values(:dni,:nombre,:apellidos,:contrasenia,:baja)");
            $crearGestor->bindParam(":dni", $dni);
            $crearGestor->bindParam(":nombre", $nombre);
            $crearGestor->bindParam(":apellidos", $apellidos);
            $crearGestor->bindParam(":contrasenia", $contrasenia);
            $crearGestor->bindParam(":baja", $baja);
            $crearGestor->execute();
        } else {
            $crearGestor = false;
        }
        return $crearGestor;
    }
}
