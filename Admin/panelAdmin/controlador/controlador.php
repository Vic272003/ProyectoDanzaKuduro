<?php
$clientesActivo = "";
$monitoresActivo = "";
$inicioActivo = "";
$eventosActivo = "";
$gestoresActivo = "";

if (isset($_GET['sec'])) {    //Dependiendo del get que se nos pase irá a distintos sitios
    switch ($_GET['sec']) {
        case "clientes":
            $clientesActivo = "active";
            $pagina = ("./clientes/clientes.php"); //Si el get es clientes nos llevará a la página clientes
            break;
        case "monitores":
            $monitoresActivo = "active";
            $pagina = ("./monitores/monitores.php"); //Si el get es monitores nos llevará a la página monitores
            break;
        case "inicio":
            $inicioActivo = "active";
            $pagina = ("./inicio/inicio.php"); //Si el get es inicio nos llevará a la página inicio
            break;
        case "eventos":
            $eventosActivo = "active";
            $pagina = ("./eventos/eventos.php"); //Si el get es eventos nos llevará a la página eventos.php
            break;
        case "gestores":
            $gestoresActivo = "active";
            $pagina = ("./gestores/gestores.php"); //Si el get es gestores nos llevará a la página gestores.php
            break;
        default:
            $pagina = "./pageError.php";
            break;
    }
} else {
    $inicioActivo = "active";
    $pagina = "./inicio/inicio.php";
}
