<?php
require_once('../clases/evento.php');
include_once("../funciones.inc.php");

//Los paterns necesarios
$patternFecha = '/^[0-9]{4}$/';
$patternDia = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$patternHora = '/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/';
$patternLugar = '/^[A-Z][a-z]*$/';

include_once('./eventos/crearEvento.php');
include_once('./eventos/actualizarEvento.php');
if (isset($_POST['actualizaEvento'])) {
    if (
        preg_match($patternDia, $_POST['dia']) &&
        preg_match($patternHora, $_POST['hora']) &&
        preg_match($patternLugar, $_POST['lugar'])

    ) {

        $dia = validar_cadena($_POST['dia']);               //
        $hora = validar_cadena($_POST['hora']);         // Guardamos los datos en una variable
        $lugar = validar_cadena($_POST['lugar']);   //
        $especialidad = $_POST['grupoActualizar'];             //
        $id = validar_cadena($_POST['id']);
        $actualizarEvento = Evento::actualizarEvento($id, $dia, $hora, $lugar, $especialidad);
        if ($actualizarEvento) { ?>
            <div class="alert alert-success mt-0" role="alert">
                Evento actualizado correctamente!
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
?>

<div class="container ">
    <div class="row justify-content-center ">
        <div class="col ">
            <?php
            if (isset($_POST['buscarAnio'])) {
                if (!empty($_POST['inputAnio'])) {
                    $year = validar_cadena($_POST['inputAnio']);
                    if (preg_match($patternFecha, $year)) {
                        require_once('./eventos/listarEventosAnio.php');
                    } else { ?>
                        <div class="alert alert-danger mt-0" role="alert">
                            Pon un año correcto por favor te lo pido!
                            <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
            <?php require_once('./eventos/listarEventos.php');
                    }
                } else {
                    require_once('./eventos/listarEventos.php');
                }
            } else {
                require_once('./eventos/listarEventos.php');
            };
            if (isset($_POST['atras'])) {
                require_once('./eventos/listarEventos.php');
            }
            ?>
        </div>

    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-6">
            <?php
            //Si se pulsa el botón llamará a esa página
            // if (isset($_POST['botonModEvento'])) {
            //     include_once('./eventos/actualizarEvento.php');
            // }

            ?>
        </div>
    </div>
</div>