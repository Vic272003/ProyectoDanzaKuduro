<?php
session_start();
if (isset($_SESSION['usuario'])) {

    if (isset($_POST['botonTarifa'])) {
        $_SESSION['carrito']['tarifa']=$_POST['botonTarifa'];
        header('Location:../index.php');
        //Si el cliente paga
        
    }
}