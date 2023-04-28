<?php
session_start();
if(isset($_SESSION['usuario'])){
    if (isset($_POST['comprarEvento'])) {
        if (!isset($_SESSION['carrito']['eventos']) || !is_array($_SESSION['carrito']['eventos'])) {
            $_SESSION['carrito']['eventos'] = array();
            array_push($_SESSION['carrito']['eventos'], $_POST['comprarEvento']);
        } else {
            if (!in_array($_POST['comprarEvento'], $_SESSION['carrito']['eventos'])) {
                array_push($_SESSION['carrito']['eventos'], $_POST['comprarEvento']);
            }
        }
    }
    header('Location:../index.php');
}