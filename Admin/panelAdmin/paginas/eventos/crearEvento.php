<?php
include_once("../funciones.inc.php");
include_once("../clases/grupo.php");
if (isset($_POST['crearEvento'])) {
    if (
        preg_match($patternDia, $_POST['diaCrear']) &&
        preg_match($patternHora, $_POST['horaCrear']) &&
        preg_match($patternLugar, $_POST['lugarCrear'])
    ) {
        $dia = validar_cadena($_POST['diaCrear']);                                          //
        $hora = validar_cadena($_POST['horaCrear']);                                    //
        $lugar = validar_cadena($_POST['lugarCrear']);                              // Recogemos los datos
        $especialidad = $_POST['grupoCrear'];   
        if(empty($_POST['precioCrear'])){
            $precio = 0;
        }else{
            $precio = $_POST['precioCrear'];
        }
        $crearEvento = Evento::crearEvento($dia, $hora, $lugar, $especialidad,$precio);  //Hacemos una llamada a la función
        if ($crearEvento) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Evento creado correctamente!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger mt-0" role="alert">
                Algo está mal. Inténtelo de nuevo!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php }
    } else { ?>
        <div class="alert alert-danger mt-0" role="alert">
            Algo ha salido mal, asegurese de que los datos son correctos!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php }
}
?>
<!-- Modal -->
<div class="modal fade" id="crearEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Evento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="dia">DIA</label>
                                <input type="text" class="form-control" name="diaCrear" id="dia" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora">HORA</label>
                                <input type="text" class="form-control" name="horaCrear" id="hora" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="precio">PRECIO</label>
                                <input type="text" class="form-control" name="precioCrear" id="precio" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lugar">LUGAR</label>
                                <input type="text" class="form-control" name="lugarCrear" id="lugar">
                            </div>
                        </div>
                        <div class="row">
                                <div class="form-group mt-2 col-md-6">
                                    <label for="grupo">Especialidad</label>
                                    <select name="grupoCrear" class="form-control">
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
                <button type="submit" name="crearEvento" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>