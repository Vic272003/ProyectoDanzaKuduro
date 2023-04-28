<?php
include_once("../funciones.inc.php");
include_once("../clases/grupo.php");
if (isset($_POST['actualizarEvento'])) {
    if (
        preg_match($patternDia, $_POST['diaActualizar']) &&
        preg_match($patternHora, $_POST['horaActualizar']) &&
        preg_match($patternLugar, $_POST['lugarActualizar'])
    ) {             //
        $dia = validar_cadena($_POST['diaActualizar']);               //
        $hora = validar_cadena($_POST['horaActualizar']);         // Guardamos los datos en una variable
        $lugar = validar_cadena($_POST['lugarActualizar']);   //
        $especialidad = $_POST['eventoActualizar'];             //
        $precio = $_POST['precioActualizar'];
        $id = validar_cadena($_POST['idActualizar']);
        $actualizarEvento = Evento::actualizarEvento($id, $dia, $hora, $lugar, $especialidad);
        if ($actualizarEvento) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Evento actualizado correctamente!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
    } else { ?>
        <div class="alert alert-danger mt-0" role="alert">
            Algo ha salido mal, asegurese de que los datos son correctos!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button><br>
        </div>
<?php
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="actualizararEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Evento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="dia">DIA</label>
                                <input type="text" class="form-control" name="diaActualizar" id="diaActualizar" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora">HORA</label>
                                <input type="text" class="form-control" name="horaActualizar" id="horaActualizar" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="precio">PRECIO</label>
                                <input type="text" class="form-control" name="precioActualizar" id="precioActualizar" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lugar">LUGAR</label>
                                <input type="text" class="form-control" name="lugarActualizar" id="lugarActualizar">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mt-2 col-md-6">
                                <label for="grupo">Especialidad</label>
                                <select name="eventoActualizar" class="form-control">
                                    <?php
                                    //Listamos los grupos
                                    $grupos = Grupo::listarGrupos();
                                    foreach ($grupos as $grupo) {
                                        echo "<option value='" . $grupo['especialidad'] . "'>" . $grupo['especialidad'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" name="actualizarEvento" class="btn btn-primary">Actualizar</button>
                <input type="hidden" name="idActualizar" id="idActualizar">
                </form>
            </div>
        </div>
    </div>
</div>