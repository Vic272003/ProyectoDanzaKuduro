<?php
include_once('./clases/cliente.php');
include_once('./paginas/modales/modalTarifas.php');
//Si pulsa el botón se sabe la tarifa que es




foreach ($todasTarifas as $tarifa) {
    if ($tarifa['nombre'] != 'Caducado') {
?>
        <article id="<?php echo $tarifa['nombre'] ?>">
            <h4><?php echo $tarifa['nombre'] ?></h4>
            <p>Descuento de <?php echo $tarifa['descuento'] ?>% </p>
            <ul>
                <li>Lorem </li>
                <li>Ipsum</li>
                <li>Dummy </li>
                <li>Printing</li>
            </ul>
            <form action="./paginas/comprarTarifa.php" method="post">
                <?php
                if (isset($_SESSION['usuario'])) {
                    if ($tarifa['id'] == $_SESSION['tarifa']) { ?>
                        <button class="comprada" disabled>Comprada</button>
                    <?php } else { ?>

                        <button type="submit" class="btn comprar" name="botonTarifa" value="<?php echo $tarifa['id'] ?>">Comprar</button>
            </form>
        <?php }
                } else {
        ?>
        <button type="button" class="btn comprar" data-bs-toggle="modal" data-bs-target="#alertaRegistrarte">
            Comprar
        </button>
    <?php  }
    ?>

        </article>



<?php }
}

?>