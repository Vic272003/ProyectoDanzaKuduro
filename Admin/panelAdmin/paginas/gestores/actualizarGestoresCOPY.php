<?php
include_once("../funciones.inc.php");


$recogeDni=validar_inputSinModificar('sacarDniAlta');
$recogeDatosGestor=Gestor::listaGestor($recogeDni);

?>
<div class="card">
    <div class="card-header align-items-center">
                    <h4 class="card-title mb-0">Actualizar Gestor</h4>
    </div>
    <div class="card-body">
            <form  method="post">
                <div class="row">
                <?php 
                    foreach ($recogeDatosGestor as $atributo => $dato) { ?>
                        <div class="col-6">
                            <label for="<?php echo $atributo ?>" class="form-label mt-2"><strong><?php echo strtoupper($atributo) ?></strong></label>
                            <input type="text" required class="form-control mb-3" name="<?php echo $atributo ?>" value="<?php echo $dato ?>">
                        </div> 
                <?php 
                    
                }
                ?>
                <div class="col-6">
                            <label for="pass" class="form-label mt-2"><strong>Contraseña</strong></label>
                            <input type="text" required class="form-control mb-3" name="pass" placeholder="Ingrese Contraseña">
                        </div> 
                </div>
                <div class="row justify-content-center">
                <button type="submit" name="actualizaGestor" class="btn btn-primary btn-sm col-3">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>