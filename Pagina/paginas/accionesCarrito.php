<?php
session_start();
include_once('../clases./evento.php');
include_once('../clases./cliente.php');
include_once('../clases./inscrito.php');
include_once('../clases./tarifa.php');
if (isset($_POST['vaciarCarrito'])) {
    unset($_SESSION['carrito']['tarifa']);
    unset($_SESSION['carrito']['eventos']);
}
if (isset($_POST['comprarCarrito'])) {
    if (!empty($_SESSION['carrito']['tarifa'])) {
        $_SESSION['tarifa'] = $_POST['idTarifa'];
        $cambiarTarifa = Cliente::cambiarTarifaCliente($_SESSION['usuario'], $_SESSION['tarifa']);
    }
    if (!empty($_SESSION['carrito']['eventos'])) {
        $eventoComprar = $_SESSION['carrito']['eventos'][0];
        $precioEvento = Evento::sacarPrecioEvento($eventoComprar);
        $descuentoPuesto = Tarifa::sacarDescuento($_SESSION['tarifa']);

        $compraEvento = Inscrito::compraEventoRelacion($eventoComprar, $_SESSION['usuario'], $descuentoPuesto['descuento'], $precioEvento['precio']);
        
    }
    unset($_SESSION['carrito']['tarifa']);
        unset($_SESSION['carrito']['eventos']);
        header('Location:../index.php');
}
