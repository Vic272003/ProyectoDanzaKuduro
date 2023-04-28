<?php
include_once("../funciones.inc.php");
include_once("../clases/grupo.php");

//Recogemos el dni y los datos del cliente por dni
$recogeDni = validar_inputSinModificar('sacarDniAlta');
$recogeDatosCliente = Cliente::listaCliente($recogeDni);

?>
<div class="card">
    <div class="card-header align-items-center">
        <h4 class="card-title mb-0">Actualizar Cliente</h4>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <?php
                foreach ($recogeDatosCliente as $atributo => $dato) { ?>
                    <div class="col-6">
                        <label for="<?php echo $atributo ?>" class="form-label mt-2"><strong><?php echo strtoupper($atributo) ?></strong></label>
                        <input type="text" required class="form-control mb-3" name="<?php echo $atributo ?>" value="<?php echo $dato ?>">
                    </div>
                <?php

                }
                ?>
                <div class="col-6">
                    <label for="pass" class="form-label mt-2"><strong>PASS</strong></label>
                    <input type="text" required class="form-control mb-3" name="pass" placeholder="Ingrese Contraseña">
                </div>
            </div>
            <div class="row ">
                <div class="col-6">
                    <div class="form-group mt-2 col-md">
                        <label for="grupo">GRUPO</label>
                        <select name="grupoActualizar" class="form-control mb-3">
                            <?php
                            //Listamos los grupos
                            $grupos = Grupo::listarGrupos();
                            foreach ($grupos as $grupo) {
                                echo "<option value='" . $grupo['codigo'] . "'>" . $grupo['especialidad'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button type="submit" name="actualizaCliente" class="btn btn-primary btn-sm col-3">Actualizar</button>
            </div>
        </form>
    </div>
</div>
</div>