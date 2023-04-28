<?php
if ($_SESSION['dni'] == '00000000A') {
    //Incluiremos los ficheros que necesitamos
    require_once('../clases/gestor.php');
    include_once("../funciones.inc.php");
    $patternNombre = '/^[A-Za-záéíóú]*$/';
    $patternDni = '/^[0-9]{8}[A-Z]$/';
    $patternApellidos = '/^[A-Z][a-záéíóú]* [A-Z][a-záéíóú]*$/';

    //Si se ha dado al botón llamado actualizaGestor que está en actualizarGestor.php entra
    if (isset($_POST['actualizaGestor'])) {
        if (
            preg_match($patternDni, $_POST['dni']) &&
            preg_match($patternNombre, $_POST['nombre']) &&
            preg_match($patternApellidos, $_POST['apellidos']) &&
            !empty($_POST['pass'])
        ) {
            $dni = validar_cadena($_POST['dni']);               //
            $nombre = validar_cadena($_POST['nombre']);         // Guardamos los datos en una variable
            $apellidos = validar_cadena($_POST['apellidos']);   //
            $password = password_hash(validar_cadena($_POST['pass']), PASSWORD_DEFAULT); //Guardamos la contraseña encriptada
            $prueba = Gestor::actualizarGestor($dni, $nombre, $apellidos, $password); //Llamamos a la función de la clase Gestor
            if ($prueba) { ?>
                <div class="alert alert-success mt-0" role="alert">
                    Gestor actualizado correctamente!
                    <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
        } else { ?>
            <div class="alert alert-danger mt-0" role="alert">
                Algo ha salido mal, asegurese de que los datos son correctos!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button><br>
                Dni: 8 numeros y una letra<br>
                Ej Nombre: Marta<br>
                Ej Apellidos: Gomez Sanchez<br>
                Ej Contraseña: 1234<br>

            </div>
        <?php
        }
    }

    //Si se ha dado al botón llamado botonElim entra
    if (isset($_POST['botonElim'])) {
        include_once('./gestores/eliminarGestor.php');  //Llamamos al siguiente fichero
        if ($recogeDatosGestor) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Gestor dado de baja correctamente!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
    }

    //Si se ha dado al botón llamado darAlta que está en la tabla de Gestores de baja entra
    if (isset($_POST['darAlta'])) {
        include_once('./gestores/darAltaGestor.php');   //Llamamos al siguiente fichero
        if ($darAlta) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Gestor dado de alta de nuevo correctamente!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
        }
    }
    //Incluimos el fichero crearGestor
    include_once('./gestores/crearGestor.php');
    include_once('./gestores/actualizarGestores.php');



    $listadoGestores = Gestor::listadoGestores();  //Recogemos el listado de Gestors activos y lo mostramos
    $listadoGestoresBaja = Gestor::listadoGestoresBaja(); //Recogemos el listado de Gestors de baja y lo mostramos
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
                        <h4 class="card-title mb-0 ">Gestores Activos</h4>
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#crearGestor" name="crearGestor" class="btn btn-success btn-sm">Añadir Gestor</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <?php
                                    //Hacemos un forEach para recoger una sola vez los atributos del gestor
                                    foreach ($listadoGestores as $gestor) {

                                        if ($contadorFor == 0) {
                                            //Hacemos un segundo foreach para recoger su atributo
                                            foreach ($gestor as $atributo => $valor) { ?>
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
                                //Este foreach recorre los diferentes Gestors
                                foreach ($listadoGestores as $gestor) { ?>
                                    <tr>
                                        <?php
                                        //Este segundo foreach mostrará el valor de cada gestor
                                        foreach ($gestor as $atributo => $valor) {
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
                                            <!-- Este input recoge el dni de cada gestor para luego poder recogerlo -->
                                            <input type="hidden" value="<?php echo $valorDniAlta ?>" name="sacarDniAlta">
                                            <td>
                                                <!-- Dependiendo de cuál pulse, se harán modificaciones o se eliminará de activos -->
                                                <button  data-dni="<?php echo $valorDniAlta;?>" data-nombre="<?php echo $valorNombre;?>" data-apellidos="<?php echo $valorApellidos;?>" type="button" name="botonMod" class="icono botonMod" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#actualizararGestor"><i class="icofont-options icono"></i></button>
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
                <!-- Fin de la tabla Gestors dados de alta -->
            </div>

            <!-- Comienzo tabla de cientes baja -->
            <div class="col-6 ">
                <div class="card bg-white">
                    <div class="card-header align-items-center">
                        <h4 class="card-title mb-0">Gestores dados de Baja</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead class="table-light">
                                <tr>
                                    <?php
                                    $contadorFor = 0; //Reiniciamos el contador
                                    //Hacemos un forEach para recoger una sola vez los atributos del gestor
                                    foreach ($listadoGestoresBaja as $GestorBaja) {

                                        if ($contadorFor == 0) {
                                            //Hacemos un segundo foreach para recoger su atributo
                                            foreach ($GestorBaja as $atributo => $valor) { ?>
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
                                //Este foreach recorre los diferentes Gestors
                                foreach ($listadoGestoresBaja as $GestorBaja) { ?>
                                    <tr>
                                        <?php
                                        //Este segundo foreach mostrará el valor de cada gestor
                                        foreach ($GestorBaja as $atributo => $valor) {
                                            if ($atributo == "dni") {
                                                $valorDniBaja = $valor;
                                            }
                                        ?>
                                            <td><?php echo $valor ?></td>

                                        <?php } ?>
                                        <form method="post">
                                            <!-- Este input recoge el dni de cada gestor para luego poder recogerlo -->
                                            <input type="hidden" value="<?php echo $valorDniBaja ?>" name="sacarDniBaja">
                                            <td>
                                                <!-- Si se pulsa se llamará al fichero darAltaGestor.php -->
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
                <!-- Fin de la tabla Gestors dados de baja -->
            </div>
            <!-- Fin de la fila -->
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-8">
                <?php
                //Si se pulsa el botón llamará a esa página
                // if (isset($_POST['botonMod'])) {
                //     include_once('./gestores/actualizarGestores.php');
                // }

                ?>
            </div>
        </div>
    </div>
<?php }else{
    header("Location: ./index.php?sec=error");
    
}
