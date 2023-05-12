<?php
include_once('./clases/grupo.php');
include_once('./clases/horario.php');
include_once('./clases/evento.php');
include_once('./clases/inscrito.php');
include_once('./clases/tarifa.php');
include_once('./clases/monitor.php');

$horario = null;
if ($_SESSION['tipo'] == 'cliente') {
    $especialidad = Grupo::obtenerNombreGrupo($_SESSION['grupo']);

    $listadoEventos = Evento::listadoEventosXCodGrupo($especialidad);
    $eventosDeUsuario = Inscrito::saberInscritosXDni($_SESSION['usuario']);
    $estaComprado = false;
    $descuentoHacer = Tarifa::sacarDescuento($_SESSION['tarifa']);
    $horario = Horario::verHorarioCodGrupo($_SESSION['grupo']);
} else {
    $especialidad = $_SESSION['especialidad'];
    $codEspecialidad = Grupo::obtenerIdGrupo($especialidad);
    $infoMonitor = Monitor::listaMonitor($_SESSION['usuario']);
    $horario = Horario::verHorarioCodGrupoYMonitor($_SESSION['usuario']);
}
include_once('./paginas/modales/actualizarClase.php');
include_once('./paginas/modales/createClase.php');

?>

<!-- Scrollable modal -->
<div class="modal modal-xl fade modal-dialog-scrollable" id="horario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if ($_SESSION['tipo'] == 'cliente') { ?>
                    <h5 class="modal-title" id="Horario">Horario para el grupo <?php echo $especialidad ?></h5>
                <?php  } else { ?>
                    <h5 class="modal-title" id="Horario">Buenas <?php echo $infoMonitor['nombre'] . " " . $infoMonitor['apellidos'] . ". Esta es tu planificación" ?> </h5>
                <?php }
                ?>

                <?php
                if ($_SESSION['tipo'] == 'monitor') { ?>
                    <button type="button" name="crearClase" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearClase">Añadir Clase</button>

                <?php } else { ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <?php }
                ?>
            </div>
            <!-- EL BODY -->
            <div class="modal-body">
                <?php
                if ($horario != null) { ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Dia</th>
                                <th scope="col">Hora_inicio</th>
                                <th scope="col">Hora_fin</th>
                                <?php
                                if ($_SESSION['tipo'] == 'cliente') { ?>
                                    <th scope="col">Monitor</th>
                                <?php } else { ?>
                                    <th scope="col">Acciones</th>
                                <?php }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($horario as $horario) { ?>
                                <tr>
                                    <th scope="row"><?php echo $horario['dia'] ?></th>
                                    <td><?php echo $horario['hora_inicio'] ?></td>
                                    <td><?php echo $horario['hora_fin'] ?></td>
                                    <?php
                                    if ($_SESSION['tipo'] == 'cliente') { ?>
                                        <td><?php echo $horario['nombre'] ?> </td>
                                    <?php } else { ?>
                                        <td><button data-dia="<?php echo $horario['dia']?>" data-inicio="<?php echo $horario['hora_inicio']?>" data-fin="<?php echo $horario['hora_fin']?>" type="button" name="botonModClase" class="icono botonModClase" style="background-color: transparent;margin-left:20px" data-bs-toggle="modal" data-bs-target="#actualizarClase" ><i class="icofont-options icono"></i></button></td>
                                    <?php }
                                    ?>

                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>No hay horario disponible</p>";
                }
                ?>
                <?php
                if ($_SESSION['tipo'] == 'cliente') {

                ?>
                    <h5 class="modal-title" id="Horario">Eventos para el grupo <?php echo $especialidad ?></h5>
                    <?php
                    if ($listadoEventos != null) { ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Precio Con Descuento</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col">Comprar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="./paginas/comprarEventos.php" method="post">
                                    <?php
                                    foreach ($listadoEventos as $listadoEventos) {
                                        $precioADescontar = $listadoEventos['precio'] - $listadoEventos['precio'] * $descuentoHacer['descuento'] / 100; ?>
                                        <tr>
                                            <th scope="row"><?php echo $listadoEventos['dia'] ?></th>
                                            <td><?php echo $listadoEventos['hora'] ?></td>
                                            <td><?php echo $listadoEventos['precio'] . "€" ?></td>
                                            <td><?php echo $precioADescontar . "€" ?></td>
                                            <td><?php echo $listadoEventos['lugar'] ?> </td>
                                            <?php
                                            foreach ($eventosDeUsuario as $inscrito) {
                                                if ($inscrito['id_evento'] == $listadoEventos['id']) {
                                            ?>
                                                    <td><button disabled type="submit" name="comprado" value="<?php echo $listadoEventos['id'] ?>" class="btn btn-success">Comprado</button></td>
                                                    <?php
                                                    $estaComprado = true;
                                                }
                                            }
                                            if (!$estaComprado) {
                                                if (isset($_SESSION['carrito']['eventos'])) {
                                                    if (in_array($listadoEventos['id'], $_SESSION['carrito']['eventos'])) {

                                                    ?>
                                                        <td><button disabled type="submit" name="aniadidoCarrito" value="<?php echo $listadoEventos['id'] ?>" class="btn btn-success">Añadido al Carrito</button></td>

                                                    <?php } else { ?>
                                                        <td><button type="submit" name="comprarEvento" value="<?php echo $listadoEventos['id'] ?>" class="btn btn-success">Comprar</button></td>
                                                    <?php  }
                                                } else { ?>
                                                    <td><button type="submit" name="comprarEvento" value="<?php echo $listadoEventos['id'] ?>" class="btn btn-success">Comprar</button></td>
                                            <?php }
                                            } ?>



                                        </tr>
                                    <?php
                                        $estaComprado = false;
                                    } ?>
                                </form>
                            </tbody>
                        </table>
                <?php
                    } else {
                        echo "<p>No hay Eventos disponibles</p>";
                    }
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
