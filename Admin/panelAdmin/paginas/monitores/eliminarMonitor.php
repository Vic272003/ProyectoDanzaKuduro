<?php
include_once("../funciones.inc.php");


$recogeDni=validar_inputSinModificar('sacarDniAlta');
$recogeDatosMonitor=Monitor::eliminarMonitor($recogeDni);   //Llamamos a la función de la clase