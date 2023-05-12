<?php
require_once 'conexion.php';
/**
 * Clase cliente 
 */
class Cliente{
    private $dni;
    public function __construct($dni){

            $this->dni=$dni;
        
    }
    /**
     * Lista los clientes activos
     */
    public static function listadoClientes(){
        try {
            $conectar=new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoClientes=$conectar->query("Select dni,nombre,apellidos from cliente where baja='no' ;");
            if($listadoClientes->rowCount()>0){
                $infoClientes=$listadoClientes->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
            
        };
        return $infoClientes;
    }
    /**
     * Lista los clientes que están dados de baja
     */
    public static function listadoClientesBaja(){
        try {
            $conectar=new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoClientes=$conectar->query("Select dni,nombre,apellidos from cliente where baja='si' ;");
            if($listadoClientes->rowCount()>0){
                $infoClientes=$listadoClientes->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
            
        };
        return $infoClientes;
    }
    /**
     * Actualiza los datos dni, nombre y apellidos del cliente
     */
    public static function actualizarCliente($dni, $nombre,$apellidos,$codGrupo,$password){
        try {
            $conectar=new Conexion();
        }catch(Exception $ex){
            $resultado="La conexion no la hace";
        }
            
            $existeCliente=$conectar->query("Select nombre from cliente  where dni='$dni';");
            if($existeCliente->rowCount()>0){
                if(empty($password)){
                    $sql_contrasena = "";
                }else{
                    $sql_contrasena = ",contrasenia='$password'";
                }
                $sql = "UPDATE cliente
                    SET dni='$dni',nombre='$nombre',apellidos='$apellidos',cod_grupo='$codGrupo'$sql_contrasena WHERE dni='$dni'";
                $actCliente= $conectar->query($sql);

                $resultado=true;
            }else{
                $resultado=false;
            }
        
        return $resultado;
    }
    /**
     * Lista los datos dni, nombre y apellidos pasándole el dni
     */
    public static function listaCliente($dni){
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select dni,nombre,apellidos from cliente  where dni='$dni';");
        if($existeCliente->rowCount()>0){
            $infoCliente=$existeCliente->fetch(PDO::FETCH_ASSOC);
        }
        return $infoCliente;
    }
    /**
     * Da de baja el cliente pasándole el dni
     */
    public static function eliminarCliente($dni){
        $resultado=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select nombre from cliente  where dni='$dni';");
        if($existeCliente->rowCount()>0){
            $elimCliente= $conectar->query("UPDATE cliente SET baja='si' WHERE dni='$dni'");
            $resultado=true;
        }
        return $resultado;
    }
    /**
     * Da de alta el cliente pasándole por parámetro el dni
     */
    public static function darAltaCliente($dni){
        $resultado=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select nombre from cliente  where dni='$dni';");
        if($existeCliente->rowCount()>0){
            $darAlta= $conectar->query("UPDATE cliente SET baja='no' WHERE dni='$dni'");
            $resultado=true;
        }
        return $resultado;
    }
    /**
     * Crea un cliente
     */
    public static function crearCliente($dni,$nombre,$apellidos,$contrasenia,$codGrupo,$dnicliente){
        $fechaAlta=date('Y-m-d');
        $baja="no";
        $idTarifa=1;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select nombre from cliente  where dni='$dni';");
        if($existeCliente->rowCount()==0){
            $crearCliente= $conectar->prepare("Insert into  cliente  (dni,id_tarifa,dni_clienteC,cod_grupo,nombre,apellidos,contrasenia,baja,fecha_alta,fecha_pago_tarifa) values(:dni,:tarifa,:cliente,:cod_grupo,:nombre,:apellidos,:contrasenia,:baja,:fecha_alta,:fecha_pago_tarifa)");
            $crearCliente->bindParam(":dni", $dni);
            $crearCliente->bindParam(":tarifa", $idTarifa);
                $crearCliente->bindParam(":cod_grupo", $codGrupo);
                $crearCliente->bindParam(":nombre", $nombre);
                $crearCliente->bindParam(":cliente", $dnicliente);
                $crearCliente->bindParam(":apellidos", $apellidos);
                $crearCliente->bindParam(":contrasenia", $contrasenia);
                $crearCliente->bindParam(":baja", $baja);
                $crearCliente->bindParam(":fecha_alta", $fechaAlta);
                $crearCliente->bindParam(":fecha_pago_tarifa", $fechaAlta);
                $crearCliente->execute();
            
                
        }else{
            $crearCliente=false;
        }
        return $crearCliente;
    }
    /**
     * Lista las fechas de los clientes creados
     */
    public static function listaClienteFechasAlta($anio){
        $infoCliente=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("SELECT fecha_alta from cliente  where EXTRACT(YEAR FROM fecha_alta)='$anio';");
        if($existeCliente->rowCount()>0){
            $infoCliente=$existeCliente->fetchAll(PDO::FETCH_ASSOC);
        }
        return $infoCliente;
    }
    /**
     * Comprueba el cliente pasándole la contraseña
     */
    public static function comprobarCliente($dni, $password)
    {
        $datosCorrectos = false;
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $existecliente = $conectar->query("Select contrasenia from cliente where dni='$dni' and baja='no';");
            if ($existecliente->rowCount() > 0) {
                $infoClientes = $existecliente->fetch(PDO::FETCH_ASSOC);
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
    public static function obtenerTarifa($dni){
        $tarifa=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select id_tarifa from cliente  where dni='$dni';");
        if($existeCliente->rowCount()>0){
            $infoCliente=$existeCliente->fetch(PDO::FETCH_ASSOC);
            $tarifa=$infoCliente['id_tarifa'];
        }
        return $tarifa;

    }
    public static function obtenerGrupo($dni){
        $grupo=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select cod_grupo from cliente  where dni='$dni';");
        if($existeCliente->rowCount()>0){
            $infoCliente=$existeCliente->fetch(PDO::FETCH_ASSOC);
            $grupo=$infoCliente['cod_grupo'];
        }
        return $grupo;
    }
    public static function cambiarTarifaCliente($dni,$tarifa){
        $resultado=false;
        try {
            $conectar=new Conexion();
            
        }catch(Exception $ex){

        }
        $existeCliente=$conectar->query("Select id_tarifa from cliente  where dni='$dni';");
        if($existeCliente->rowCount()>0){

            $cambiarTarifa= $conectar->query("UPDATE cliente SET id_tarifa='$tarifa' WHERE dni='$dni'");
            $resultado=true;
        }
        return $resultado;
    }
}