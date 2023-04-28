<?php
include_once("../funciones.inc.php");        //Llamamos a las funciones


$recogeDni=validar_inputSinModificar('sacarDniBaja');   
$darAlta=Cliente::darAltaCliente($recogeDni);   //Llamamos a la función de la clase Cliente