<?php
//Incluiremos los ficheros que necesitamos
require_once('../clases/monitor.php');
include_once("../funciones.inc.php");
$patternNombre = '/^[A-Za-záéíóú]*$/';
$patternDni = '/^[0-9]{8}[A-Z]$/';
$patternApellidos = '/^[A-Z][a-záéíóú]* [A-Z][a-záéíóú]*$/';



//Si se ha dado al botón llamado botonElim entra
if (isset($_POST['botonElim'])) {
    include_once('./monitores/eliminarMonitor.php');  //Llamamos al siguiente fichero
    if ($recogeDatosMonitor) { ?>
        <div class="alert alert-success mt-0" role="alert">
            Monitor dado de baja correctamente!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}

//Si se ha dado al botón llamado darAlta que está en la tabla de Monitors de baja entra
if (isset($_POST['darAlta'])) {
    include_once('./monitores/darAltaMonitor.php');   //Llamamos al siguiente fichero
    if ($darAlta) { ?>
        <div class="alert alert-success mt-0" role="alert">
            Monitor dado de alta de nuevo correctamente!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}
//Incluimos el fichero crearMonitor
include_once('./monitores/crearMonitor.php');
include_once('./monitores/actualizarMonitor.php');


$listadoMonitores = Monitor::listadoMonitores();  //Recogemos el listado de Monitors activos y lo mostramos
$listadoMonitorsBaja = Monitor::listadoMonitoresBaja(); //Recogemos el listado de Monitors de baja y lo mostramos
$contadorFor = 0;   //Este contador se usará para recoger los atributos de los valores una sola vez
$valorDniAlta;      //Recogemos el valor del DNI de los usuarios activos
$valorDniBaja;      //Recogemos el valor del DNI de los usuarios de baja
$valorNombre;
$valorApellidos;

?>
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-6 ">
            <div class="card bg-white">
                <div class="card-header align-items-center d-flex justify-content-between ">
                    <h4 class="card-title mb-0 ">Monitores Activos</h4>
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#crearMonitor" name="crearMonitor" class="btn btn-success btn-sm">Añadir Monitor</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <?php
                                //Hacemos un forEach para recoger una sola vez los atributos del monitor
                                foreach ($listadoMonitores as $monitor) {

                                    if ($contadorFor == 0) {
                                        //Hacemos un segundo foreach para recoger su atributo
                                        foreach ($monitor as $atributo => $valor) { ?>
                                            <th scope="col"><?php echo strtoupper($atributo) ?></th>
                                <?php

                                        }
                                    }
                                    $contadorFor = 100;
                                }
                                ?>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Este foreach recorre los diferentes Monitors
                            foreach ($listadoMonitores as $monitor) { ?>
                                <tr>
                                    <?php
                                    //Este segundo foreach mostrará el valor de cada monitor
                                    foreach ($monitor as $atributo => $valor) {
                                        if ($atributo == "dni") {
                                            $valorDniAlta = $valor;
                                        }
                                        if ($atributo == "nombre") {
                                            $valorNombre = $valor;
                                        }
                                        if ($atributo == "apellidos") {
                                            $valorApellidos = $valor;
                                        }
                                        ?>

                                        <td><?php echo $valor ?></td>

                                    <?php } ?>
                                    <form method="post">
                                        <!-- Este input recoge el dni de cada monitor para luego poder recogerlo -->
                                        <input type="hidden" value="<?php echo $valorDniAlta ?>" name="sacarDniAlta">
                                        <td>
                                            <!-- Dependiendo de cuál pulse, se harán modificaciones o se eliminará de activos -->
                                            <button  data-dni="<?php echo $valorDniAlta;?>" data-nombre="<?php echo $valorNombre;?>" data-apellidos="<?php echo $valorApellidos;?>" type="button" name="botonMod" class="icono botonMod" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#actualizararMonitor"><i class="icofont-options icono"></i></button>
                                            <button type="submit" name="botonElim" class="icono" style="background-color: transparent;"><i class="icofont-ui-delete borrar icono" style="margin-left: 20px;"></i></button>
                                        </td>
                                    </form>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fin de la tabla Monitors dados de alta -->
        </div>

        <!-- Comienzo tabla de cientes baja -->
        <div class="col-6 ">
            <div class="card bg-white">
                <div class="card-header align-items-center">
                    <h4 class="card-title mb-0">Monitores dados de Baja</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <?php
                                $contadorFor = 0; //Reiniciamos el contador
                                //Hacemos un forEach para recoger una sola vez los atributos del monitor
                                foreach ($listadoMonitorsBaja as $MonitorBaja) {

                                    if ($contadorFor == 0) {
                                        //Hacemos un segundo foreach para recoger su atributo
                                        foreach ($MonitorBaja as $atributo => $valor) { ?>
                                            <th scope="col"><?php echo strtoupper($atributo) ?></th>
                                <?php

                                        }
                                    }
                                    $contadorFor = 100;
                                }
                                ?>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Este foreach recorre los diferentes Monitors
                            foreach ($listadoMonitorsBaja as $MonitorBaja) { ?>
                                <tr>
                                    <?php
                                    //Este segundo foreach mostrará el valor de cada monitor
                                    foreach ($MonitorBaja as $atributo => $valor) {
                                        if ($atributo == "dni") {
                                            $valorDniBaja = $valor;
                                        }
                                    ?>
                                        <td><?php echo $valor ?></td>

                                    <?php } ?>
                                    <form method="post">
                                        <!-- Este input recoge el dni de cada monitor para luego poder recogerlo -->
                                        <input type="hidden" value="<?php echo $valorDniBaja ?>" name="sacarDniBaja">
                                        <td>
                                            <!-- Si se pulsa se llamará al fichero darAltaMonitor.php -->
                                            <button type="submit" name="darAlta" class="btn btn-success btn-sm">Dar de Alta</button>
                                        </td>
                                    </form>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Fin de la tabla Monitors dados de baja -->
        </div>
        <!-- Fin de la fila -->
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-8">
            <?php
            //Si se pulsa el botón llamará a esa página
            // if (isset($_POST['botonMod'])) {
            //     include_once('./monitores/actualizarMonitor.php');
            // }

            ?>
        </div>
    </div>
</div>
<?php
