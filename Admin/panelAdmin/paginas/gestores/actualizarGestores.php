<?php
include_once("../funciones.inc.php");
include_once("../clases/grupo.php");
if (isset($_POST['actualizarGestor'])) {
    if (
        preg_match($patternNombre, $_POST['nombreActualizar']) &&
        preg_match($patternApellidos, $_POST['apellidosActualizar'])
    ) {             //
        $nombre = validar_cadena($_POST['nombreActualizar']);         // Guardamos los datos en una variable
        $apellidos = validar_cadena($_POST['apellidosActualizar']);   //
        $dni = validar_cadena($_POST['dniActualizar']);
        if (empty($_POST['passActualizar'])) {
            $password = "";
        } else {
            $password = password_hash(validar_cadena($_POST['passActualizar']), PASSWORD_DEFAULT); //Guardamos la contraseña encriptada
        }
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
            Ej Nombre: Marta<br>
            Ej Apellidos: Gomez Sanchez<br>
            Ej Contraseña: 1234<br>

        </div>
<?php
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="actualizararGestor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Gestor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="dni">DNI</label>
                                <input type="text" readonly class="form-control" name="dniActualizar" id="dniActualizar" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">NOMBRE*</label>
                                <input type="text" class="form-control" name="nombreActualizar" id="nombreActualizar" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="apellidos">APELLIDOS*</label>
                                <input type="text" class="form-control" name="apellidosActualizar" id="apellidosActualizar">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">CONTRASEÑA</label>
                                <input type="password" class="form-control" name="passActualizar" id="passwordActualizar">
                            </div>

                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" name="actualizarGestor" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>