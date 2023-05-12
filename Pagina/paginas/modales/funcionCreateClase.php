<?php 
session_start();
include_once('../../clases/horario.php');
include_once('../../clases/grupo.php');
if(isset($_POST['crearClases'])){
    $dia = $_POST['diaCrear'];
    $inicio = $_POST['inicioCrear'];
    $fin = $_POST['finCrear'];
    $idGrupo=Grupo::obtenerIdGrupo($_SESSION['especialidad']);
    Horario::crearClase($dia,$inicio,$fin,$idGrupo,$_SESSION['usuario']);
    $_SESSION['funciones']=true;
    header("Location:../../index.php");
}
