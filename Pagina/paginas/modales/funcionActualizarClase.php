<?php
session_start();
include_once('../../clases/horario.php');

if (isset($_POST['actualizarClases'])) {
    
    $dia = $_POST['diaActualizar'];
    $inicio = $_POST['inicoActualizar'];
    $fin = $_POST['finActualizar'];
    
    Horario::actualizarClase($_SESSION['usuario'],$dia,$inicio,$fin);
    $_SESSION['funciones']=true;
    header('Location: ../../index.php');
    
}