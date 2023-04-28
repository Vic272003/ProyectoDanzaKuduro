<?php
session_start();
include_once('./funciones.inc.php');
include_once('./clases/gestor.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../icofont/icofont.min.css">
    <link rel="stylesheet" type="text/css" href="./css/inicioSesion.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.min.css">
    <title>Iniciar Sesión</title>
</head>

<body>
    <form method="post">
        <h2>Iniciar Sesión</h2>
        <div class="input">
            <i class="icofont-id-card"></i>
            <input type="text" name="dni" placeholder="DNI"><br>
        </div>
        <div class="input">
            <i class="icofont-lock"></i>
            <input type="password" name="password" placeholder="Contraseña"><br>
        </div>
        <input type="submit" class="boton" name="enviarSesion" value="Iniciar Sesión" />
    </form>
    <?php
    if (isset($_POST['enviarSesion'])) {
        //
        $dni = validar_cadena($_POST['dni']);
        $password = validar_cadena($_POST['password']);
        $valoresCorrectos = Gestor::comprobarGestor($dni, $password);
        if ($valoresCorrectos) {
            $_SESSION['dni']=$dni;
            header('Location:./paginas/index.php');
            
        } else { ?>
            <div class="alert alert-danger mt-0" role="alert">
                Algo ha salido mal, asegurese de que los datos son correctos!
                <button type="button" class="btn-close ms-5" data-bs-dismiss="alert" aria-label="Close"></button><br>
                Recuerde que el DNI debe ser de 8 numeros y una letra y que no esté dado de baja!!!!
            </div>
    <?php }
    }
    ?>
    <script src="../bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>