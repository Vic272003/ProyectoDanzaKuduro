<?php
include_once("../funciones.inc.php");


$recogeDni=validar_inputSinModificar('sacarDniAlta');
$recogeDatosGestor=Gestor::eliminarGestor($recogeDni);   //Llamamos a la función de la clase