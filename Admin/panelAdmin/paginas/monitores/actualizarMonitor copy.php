<?php
include_once("../funciones.inc.php");


$recogeDni=validar_inputSinModificar('sacarDniAlta');
$recogeDatosMonitor=Monitor::listaMonitor($recogeDni);

?>
<div class="card">
    <div class="card-header align-items-center">
                    <h4 class="card-title mb-0">Actualizar Monitor</h4>
    </div>
    <div class="card-body">
            <form  method="post">
                <div class="row">
                <?php 
                    foreach ($recogeDatosMonitor as $atributo => $dato) { ?>
                        <div class="col-6">
                            <label for="<?php echo $atributo ?>" class="form-label mt-2"><strong><?php echo strtoupper($atributo) ?></strong></label>
                            <input type="text" required class="form-control mb-3" name="<?php echo $atributo ?>" value="<?php echo $dato ?>">
                        </div> 
                <?php 
                    
                }
                ?>
                <div class="col-6">
                            <label for="pass" class="form-label mt-2"><strong>Contraseña</strong></label>
                            <input type="password" class="form-control mb-3" name="pass" placeholder="xxxxxxxxxxx">
                        </div> 
                </div>
                <div class="row justify-content-center">
                <button type="submit" name="actualizaMonitor" class="btn btn-primary btn-sm col-3">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>