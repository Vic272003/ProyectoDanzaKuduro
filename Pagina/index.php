<?php
// Iniciar la sesión
session_start();
if (empty($_SESSION['tipo'])) {
    $_SESSION['tipo'] = "";
}

include_once('./clases/tarifa.php');

if (isset($_POST['closeSesion'])) {
    session_destroy();
    header('Location:./index.php');
}

$todasTarifas = Tarifa::listarTarifas();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./ficheroJquery.js" type="text/javascript"></script>
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilosindex.css">
    <link rel="stylesheet" href="./css/icofont/icofont.min.css">

    <title>DanzaKuduro</title>
</head>

<body>

    <div id="manchaRosa">
        <img src="./css/imagenes/manchaRosa.png" alt="" srcset="">
    </div>

    <header>
        <?php
        require_once('./paginas/menu.php')
        ?>
    </header>

    <?php
    if (isset($_SESSION['carritoVacio'])) {
        if ($_SESSION['carritoVacio']) { ?>
            <div style="margin-top: -10px;" class=" alert z-3  alert-success d-flex justify-content-between align-items-center" role="alert">
                <span>Se ha vaciado el carrito correctamente</span>
                <button type="button" class=" btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['carritoVacio']);
        } ?>

    <?php }
    ?>
    <?php
    if (isset($_SESSION['carritoComprado'])) {
        if ($_SESSION['carritoComprado']) { ?>
            <div style="margin-top: -10px;" class="alert z-3 alert-success d-flex justify-content-between align-items-center" role="alert">
                <span>Se ha comprado todo el carrito correctamente</span>
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['carritoComprado']);
        } ?>

    <?php }
    ?>




    <div class="ralla"></div>

    <div class="intermedio">

        <div id="informacion">
            <h3>Aprende A Moverte En Nuestra Academia De Baile</h3>
        </div>
        <img src="./css/imagenes/mujerBailando.png" alt="" srcset="">
    </div>

    <?php if ($_SESSION['tipo'] != 'monitor') { ?>
        <section id="tarifas">
            <h1>Nuestros Planes Más Fascinantes</h1>
            <div class="diferentesPlanes">
                <?php
                include_once('./paginas/tarifasConRegistro.php');
                ?>
            </div>
        </section>
    <?php }
    ?>

    <section id="contacto">
        <h1 id="contactanos">Contáctanos</h1>

        <form name="formularioContacto" class="container" action="./paginas/correo.php" method="post">
            <div class="row">
                <div class="col grupo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="col grupo">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" required>
                </div>
            </div>
            <div class="row">
                <div class="col grupo">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>
                <div class="col grupo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col grupo">
                    <label for="asunto">Mensaje:</label>
                    <textarea name="asunto" id="asunto"  rows="3"></textarea>
                    <!-- <input type="text" id="asunto" name="asunto" required> -->
                </div>
            </div>
            <button name="enviarForm" type="submit">Enviar</button>

        </form>

    </section>

    <?php
    if (isset($_SESSION['usuario'])) {

        include_once('./paginas/horario.php');
    }
    ?>
    <script src="./css/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>