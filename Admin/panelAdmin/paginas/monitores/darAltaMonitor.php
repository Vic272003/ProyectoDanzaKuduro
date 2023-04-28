<?php
include_once("../funciones.inc.php");        //Llamamos a las funciones


$recogeDni=validar_inputSinModificar('sacarDniBaja');   
$darAlta=Monitor::darAltaMonitor($recogeDni);   //Llamamos a la función de la clase Cliente