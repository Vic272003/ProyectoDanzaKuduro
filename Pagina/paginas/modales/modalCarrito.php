<?php
include_once('./clases./evento.php');
include_once('./clases./cliente.php');
include_once('./clases./inscrito.php');
// if (isset($_POST['vaciarCarrito'])) {
//     unset($_SESSION['carrito']['tarifa']);
//     unset($_SESSION['carrito']['eventos']);
// }
// if (isset($_POST['comprarCarrito'])) {
//     if (!empty($_SESSION['carrito']['tarifa'])) {
//         $_SESSION['tarifa'] = $_POST['idTarifa'];
//         $cambiarTarifa = Cliente::cambiarTarifaCliente($_SESSION['usuario'], $_SESSION['tarifa']);
//     }

//     $eventoComprar = $_SESSION['carrito']['eventos'][0];
//     $precioEvento = Evento::sacarPrecioEvento($eventoComprar);
//     $descuentoPuesto = Tarifa::sacarDescuento($_SESSION['tarifa']);

//     $compraEvento = Inscrito::compraEventoRelacion($eventoComprar, $_SESSION['usuario'], $descuentoPuesto['descuento'], $precioEvento['precio']);
//     unset($_SESSION['carrito']['tarifa']);
//     unset($_SESSION['carrito']['eventos']);
//     header('Location:../index.php');
// }
?>
<div class="modal" id="carrito">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Cabecera del modal -->
            <div class="modal-header">
                <h5 class="modal-title text-danger">Carrito de la compra</h5>
                <form action="./paginas/accionesCarrito.php" method="post">
                    <button type="submit" name="vaciarCarrito" class="btn btn-dark close" data-bs-dismiss="modal">Vaciar Carrito</button>
            </div>

            <!-- Contenido del modal -->
            <div class="modal-body">

                <?php
                if (!empty($_SESSION['carrito'])) {
                    $carrito = $_SESSION['carrito'];

                    foreach ($carrito as $key => $value) {
                        if ($key == 'eventos') {
                            echo "<p>Eventos:</p>";
                            foreach ($value as $evento) {
                                $infoEventos = Evento::listaEvento($evento);
                                echo "<p>1 X $infoEventos[dia] $infoEventos[lugar] $infoEventos[precio]€</p>";
                            }
                        } else {
                            echo "<p>Tarifas:</p>";
                            $nombreTarifa = Tarifa::saberNombre($value); ?>
                            <input type="hidden" name="idTarifa" value="<?php echo $value ?>">
                <?php
                            echo "<p>1 X plan $nombreTarifa[nombre] </p>";
                        }
                    }
                } else {
                    echo "<p>El carrito está vacío</p>";
                }
                ?>
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" name="comprarCarrito" class="btn btn-success" data-bs-dismiss="modal">Comprar</button>
                </form>
            </div>

        </div>
    </div>
</div>