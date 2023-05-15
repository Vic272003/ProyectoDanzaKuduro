<?php
//Incluiremos los ficheros que necesitamos
require_once('../clases/cliente.php');
include_once("../funciones.inc.php");
//Creamos las expresiones regulares para validar los datos
$patternNombre = '/^[A-Za-záéíóú]*$/';
$patternDni = '/^[0-9]{8}[A-Z]$/';
$patternApellidos = '/^[A-Z][a-záéíóú]* [A-Z][a-záéíóú]*$/';
$patternGrupo = '/^[A-Z]{2}[0-9]$/';

//Si se ha dado al botón llamado actualizaCliente que está en actualizarCliente.php entra
if (isset($_POST['actualizaCliente'])) {
    if (
        preg_match($patternDni, $_POST['dni']) &&
        preg_match($patternNombre, $_POST['nombre']) &&
        preg_match($patternApellidos, $_POST['apellidos']) &&
        !empty($_POST['pass'])
    ) {
        $dni = validar_cadena($_POST['dni']);               //
        $nombre = validar_cadena($_POST['nombre']);         // Guardamos los datos en una variable
        $apellidos = validar_cadena($_POST['apellidos']);   //
        $grupo = validar_cadena($_POST['grupoActualizar']);   //
        $password = password_hash(validar_cadena($_POST['pass']), PASSWORD_DEFAULT);
        $prueba = Cliente::actualizarCliente($dni, $nombre, $apellidos, $grupo, $password); //Llamamos a la función de la clase Cliente
        if ($prueba) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Cliente actualizado correctamente!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
    } else { ?>
        <div class="alert alert-danger mt-0" role="alert">
            Algo ha salido mal, asegurese de que los datos son correctos!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}

//Si se ha dado al botón llamado botonElim entra
if (isset($_POST['botonElim'])) {
    include_once('./clientes/eliminarCliente.php');  //Llamamos al siguiente fichero
    if ($recogeDatosCliente) { ?>
        <div class="alert alert-success mt-0" role="alert">
            Cliente dado de baja correctamente!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
}

//Si se ha dado al botón llamado darAlta que está en la tabla de clientes de baja entra
if (isset($_POST['darAlta'])) {
    include_once('./clientes/darAltaCliente.php');   //Llamamos al siguiente fichero
    if ($darAlta) { ?>
        <div class="alert alert-success mt-0" role="alert">
            Cliente dado de alta de nuevo correctamente!
            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
    }
}
//Incluimos el fichero crearCliente
include_once('./clientes/crearCliente.php');
include_once('./clientes/actualizarCliente.php');


$listadoClientes = Cliente::listadoClientes();  //Recogemos el listado de clientes activos y lo mostramos
$listadoClientesBaja = Cliente::listadoClientesBaja(); //Recogemos el listado de clientes de baja y lo mostramos
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
                    <h4 class="card-title mb-0 ">Clientes Activos</h4>
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#crearCliente" name="crearCliente" class="btn btn-success btn-sm">Añadir Cliente</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <?php
                                //Hacemos un forEach para recoger una sola vez los atributos del cliente
                                foreach ($listadoClientes as $cliente) {

                                    if ($contadorFor == 0) {
                                        //Hacemos un segundo foreach para recoger su atributo
                                        foreach ($cliente as $atributo => $valor) { ?>
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
                            //Este foreach recorre los diferentes clientes
                            foreach ($listadoClientes as $cliente) { ?>
                                <tr>
                                    <?php
                                    //Este segundo foreach mostrará el valor de cada cliente
                                    foreach ($cliente as $atributo => $valor) {
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
                                        <!-- Este input recoge el dni de cada cliente para luego poder recogerlo -->
                                        <input type="hidden" value="<?php echo $valorDniAlta ?>" name="sacarDniAlta">
                                        <td>
                                            <!-- Dependiendo de cuál pulse, se harán modificaciones o se eliminará de activos -->
                                            <button data-dni="<?php echo $valorDniAlta; ?>" data-nombre="<?php echo $valorNombre; ?>" data-apellidos="<?php echo $valorApellidos; ?>" type="button" name="botonMod" class="icono botonMod" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#actualizararCliente"><i class="icofont-options icono"></i></button>
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
            <!-- Fin de la tabla clientes dados de alta -->
        </div>

        <!-- Comienzo tabla de cientes baja -->
        <div class="col-6 ">
            <div class="card bg-white">
                <div class="card-header align-items-center">
                    <h4 class="card-title mb-0">Clientes dados de Baja</h4>
                </div>
                <div class="card-body">
                    <?php
                    if ($listadoClientesBaja != false) {
                    ?>
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <?php
                                    $contadorFor = 0; //Reiniciamos el contador
                                    //Hacemos un forEach para recoger una sola vez los atributos del cliente



                                    foreach ($listadoClientesBaja as $clienteBaja) {

                                        if ($contadorFor == 0) {
                                            //Hacemos un segundo foreach para recoger su atributo
                                            foreach ($clienteBaja as $atributo => $valor) { ?>
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
                                //Este foreach recorre los diferentes clientes
                                foreach ($listadoClientesBaja as $clienteBaja) { ?>
                                    <tr>
                                        <?php
                                        //Este segundo foreach mostrará el valor de cada cliente
                                        foreach ($clienteBaja as $atributo => $valor) {
                                            if ($atributo == "dni") {
                                                $valorDniBaja = $valor;
                                            }
                                        ?>
                                            <td><?php echo $valor ?></td>

                                        <?php } ?>
                                        <form method="post">
                                            <!-- Este input recoge el dni de cada cliente para luego poder recogerlo -->
                                            <input type="hidden" value="<?php echo $valorDniBaja ?>" name="sacarDniBaja">
                                            <td>
                                                <!-- Si se pulsa se llamará al fichero darAltaCliente.php -->
                                                <button type="submit" name="darAlta" class="btn btn-success btn-sm">Dar de Alta</button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
            <!-- Fin de la tabla clientes dados de baja -->
        </div>
        <!-- Fin de la fila -->
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-8">
            <?php
            // //Si se pulsa el botón llamará a esa página
            // if (isset($_POST['botonMod'])) {
            //     include_once('./clientes/actualizarCliente.php');
            // }

            ?>
        </div>
    </div>
</div>
<?php
