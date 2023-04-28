<?php
include_once("../funciones.inc.php");
include_once("../clases/grupo.php");


if (isset($_POST['crearCliente'])) {
    if (
        preg_match($patternDni, $_POST['dniCrear']) &&
        preg_match($patternNombre, $_POST['nombreCrear']) &&
        preg_match($patternApellidos, $_POST['apellidosCrear']) &&
        !empty($_POST['passCrear'])
    ) {
        $dni = validar_cadena($_POST['dniCrear']);                                          //
        $nombre = validar_cadena($_POST['nombreCrear']);                                    //
        $apellidos = validar_cadena($_POST['apellidosCrear']);                              // Recogemos los datos
        $password = password_hash(validar_cadena($_POST['passCrear']), PASSWORD_DEFAULT);    //
        $grupo = $_POST['grupoCrear'];                                                      //
        $dniGestor = $_SESSION['dni'];                                                        //
        $crearCliente = Cliente::crearCliente($dni, $nombre, $apellidos, $password, $grupo, $dniGestor);  //Hacemos una llamada a la función
        if ($crearCliente) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Cliente creado correctamente!
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
            Algo ha salido mal, asegurese de que los datos son correctos!<button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button><br>
            Dni: 8 numeros y una letra<br>
            Ej Nombre: Marta<br>
            Ej Apellidos: Gomez Sanchez<br>
            Ej Contraseña: 1234<br>

        </div>
<?php }
}
?>
<!-- Modal -->
<div class="modal fade" id="crearCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="dni">DNI</label>
                                <input type="text" class="form-control" name="dniCrear" id="dni" value="<?php if (isset($_POST['dniCrear'])) echo $_POST['dniCrear'] ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">NOMBRE</label>
                                <input type="text" class="form-control" name="nombreCrear" id="nombre" value="<?php if (isset($_POST['nombreCrear'])) echo $_POST['nombreCrear'] ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="apellidos">APELLIDOS</label>
                                <input type="text" class="form-control" name="apellidosCrear" value="<?php if (isset($_POST['apellidosCrear'])) echo $_POST['apellidosCrear'] ?>" id="apellidos">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">CONTRASEÑA</label>
                                <input type="password" class="form-control" name="passCrear" value="<?php if (isset($_POST['passCrear'])) echo $_POST['passCrear'] ?>" id="password" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group mt-2 col-md">
                                <label for="grupo">GRUPO</label>
                                <select name="grupoCrear" class="form-control">
                                    <?php
                                    $grupos = Grupo::listarGrupos();
                                    foreach ($grupos as $grupo) {
                                        echo "<option value='" . $grupo['codigo'] . "'>" . $grupo['especialidad'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" name="crearCliente" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>