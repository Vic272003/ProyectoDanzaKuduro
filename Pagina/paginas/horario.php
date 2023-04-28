<?php
include_once('./clases/grupo.php');
include_once('./clases/horario.php');
include_once('./clases/evento.php');

$horario = null;
if ($_SESSION['tipo'] == 'cliente') {
    $especialidad = Grupo::obtenerNombreGrupo($_SESSION['grupo']);
    $horario = Horario::verHorarioCodGrupo($_SESSION['grupo']);
    $listadoEventos = Evento::listadoEventosXCodGrupo($especialidad);
} else {
    $especialidad = $_SESSION['especialidad'];
}

?>
<!-- Scrollable modal -->
<div class="modal modal-xl fade modal-dialog-scrollable" id="horario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Horario">Horario para el grupo <?php echo $especialidad ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <th scope="col">Monitor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($horario as $horario) { ?>
                                <tr>
                                    <th scope="row"><?php echo $horario['dia'] ?></th>
                                    <td><?php echo $horario['hora_inicio'] ?></td>
                                    <td><?php echo $horario['hora_fin'] ?></td>
                                    <td><?php echo $horario['nombre'] ?> </td>
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

                <h5 class="modal-title" id="Horario">Eventos para el grupo <?php echo $especialidad ?></h5>
                <?php
                if ($listadoEventos != null) { ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Dia</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Lugar</th>
                                <th scope="col">Comprar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="./paginas/comprarEventos.php" method="post">
                                <?php
                                foreach ($listadoEventos as $listadoEventos) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $listadoEventos['dia'] ?></th>
                                        <td><?php echo $listadoEventos['hora'] ?></td>
                                        <td><?php echo $listadoEventos['precio'] ?></td>
                                        <td><?php echo $listadoEventos['lugar'] ?> </td>
                                        <td><button type="submit" name="comprarEvento" value="<?php echo $listadoEventos['id'] ?>" class="btn btn-success">Comprar</button></td>
                                    </tr>
                                <?php
                                } ?>
                            </form>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>No hay Eventos disponibles</p>";
                }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>