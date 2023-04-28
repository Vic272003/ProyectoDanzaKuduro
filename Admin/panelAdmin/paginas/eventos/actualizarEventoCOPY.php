<?php
include_once("../funciones.inc.php");


$recogeId = validar_inputSinModificar('sacarIdEvento');
$recogeDatosEvento = Evento::listaEvento($recogeId);

?>
<div class="card">
    <div class="card-header align-items-center">
        <h4 class="card-title mb-0">Actualizar Evento</h4>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <?php
                foreach ($recogeDatosEvento as $atributo => $dato) {
                    if ($atributo != 'id' && $atributo != 'especialidad') { ?>
                        <div class="col-6">
                            <label for="<?php echo $atributo ?>" class="form-label mt-2"><strong><?php echo strtoupper($atributo) ?></strong></label>
                            <input type="text" required class="form-control mb-3" name="<?php echo $atributo ?>" value="<?php echo $dato ?>">
                        </div>
                    <?php } else { ?>
                        <input type="hidden" name="<?php echo $atributo ?>" value="<?php echo $dato ?>">
                <?php
                    }
                }
                ?>
                <div class="col-6">
                    <div class="form-group mt-2 col-md">
                        <label for="grupo">ESPECIALIDAD</label>
                        <select name="grupoActualizar" class="form-control mb-3">
                            <?php
                            $grupos = Grupo::listarGrupos();
                            foreach ($grupos as $grupo) {
                                echo "<option value='" . $grupo['especialidad'] . "'>" . $grupo['especialidad'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="submit" name="actualizaEvento" class="btn btn-primary btn-sm col-3">Actualizar</button>
            </div>
        </form>
    </div>
</div>
</div>