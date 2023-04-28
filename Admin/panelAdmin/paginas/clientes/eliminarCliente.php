<?php
include_once("../funciones.inc.php");


$recogeDni=validar_inputSinModificar('sacarDniAlta');
$recogeDatosCliente=Cliente::eliminarCliente($recogeDni);   //Llamamos a la función de la clase