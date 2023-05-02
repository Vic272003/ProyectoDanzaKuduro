<?php
require_once 'Conexion.php';
/**
 * Clase Evento 
 */
class Evento
{
    private $dni;
    public function __construct($dni)
    {

        $this->dni = $dni;
    }
    /**
     * Lista los Eventos activos
     */
    public static function listadoEventos()
    {
        $fechaActual = date('Y-m-d');
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoEventos = $conectar->query("Select * from eventos where dia>='$fechaActual' ;");
            if ($listadoEventos->rowCount() > 0) {
                $infoEvento = $listadoEventos->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoEvento;
    }
    public static function listadoEventosXCodGrupo($grupo)
    {
        $fechaActual = date('Y');
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoEventos = $conectar->query("Select * from eventos where YEAR(dia)>='$fechaActual' and especialidad='$grupo' ;");
            if ($listadoEventos->rowCount() > 0) {
                $infoEvento = $listadoEventos->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $ex) {
        };
        return $infoEvento;
    }
    /**
     * Lista los Eventos que están dados de baja
     */
    public static function listadoEventosPorAnio($year)
    {
        try {
            $conectar = new Conexion();
            $conectar->exec("SET FOREIGN_KEY_CHECKS = 0");
            $listadoEventos = $conectar->query("Select dia,hora,lugar,especialidad from eventos where YEAR(dia)='$year' ;");
            if ($listadoEventos->rowCount() > 0) {
                $infoEvento = $listadoEventos->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $infoEvento = false;
            }
        } catch (Exception $ex) {
        };
        return $infoEvento;
    }
    /**
     * Actualiza los datos dia, hora, lugar y especialidad del Evento
     */
    public static function actualizarEvento($id, $dia, $hora, $lugar, $especialidad)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
            $resultado = "La conexion no la hace";
        }
        $existeEvento = $conectar->query("Select especialidad from eventos  where id='$id';");
        if ($existeEvento->rowCount() > 0) {
            $actEvento = $conectar->query("UPDATE eventos
                SET dia='$dia',hora='$hora',lugar='$lugar',especialidad='$especialidad' WHERE id='$id'");

            $resultado = true;
        } else {
            $resultado = false;
        }

        return $resultado;
    }
    /**
     * Lista los datos dia, hora, lugar y especialidad pasándole el dni
     */
    public static function listaEvento($id)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $existeEvento = $conectar->query("Select * from eventos  where id='$id';");
        if ($existeEvento->rowCount() > 0) {
            $infoEvento = $existeEvento->fetch(PDO::FETCH_ASSOC);
        }
        return $infoEvento;
    }

    /**
     * Crea un evento
     */
    public static function crearEvento($dia, $hora, $lugar, $especialidad, $precio)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }

        $crearEvento = $conectar->prepare("Insert into  eventos  (dia,hora,lugar,especialidad,precio) values(:dia,:hora,:lugar,:especialidad,:precio)");
        $crearEvento->bindParam(":dia", $dia);
        $crearEvento->bindParam(":hora", $hora);
        $crearEvento->bindParam(":lugar", $lugar);
        $crearEvento->bindParam(":precio", $precio);
        $crearEvento->bindParam(":especialidad", $especialidad);
        $crearEvento->execute();

        return $crearEvento;
    }
    /**
     * Lista un evento por su año
     */
    public static function listaEventosYear($anio)
    {
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $infoEvento = false;
        $existeEvento = $conectar->query("SELECT dia from eventos  where EXTRACT(YEAR FROM dia)='$anio';");
        if ($existeEvento->rowCount() > 0) {
            $infoEvento = $existeEvento->fetchAll(PDO::FETCH_ASSOC);
        }
        return $infoEvento;
    }
    public static function sacarPrecioEvento($id){
        try {
            $conectar = new Conexion();
        } catch (Exception $ex) {
        }
        $infoEvento = false;
        $existeEvento = $conectar->query("SELECT precio from eventos  where id='$id';");
        if ($existeEvento->rowCount() > 0) {
            $infoEvento = $existeEvento->fetch(PDO::FETCH_ASSOC);
        }
        return $infoEvento;
    }
}
