<?php
//Si pulsa el botón de cerrar sesión destruimos la sesión y devolvemos al usuario al inicio de sesión
if (isset($_POST['cerrarSesion'])) {
    session_destroy();
    header('Location: ../index.php');
}
$dniAdimn = $_SESSION['dni'];
?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark vh-100">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Irá el logo</span>
    </a>
    <hr>
    <ul id="menu" class="nav nav-pills flex-column mb-auto gap-2">
        <li class="nav-item">
            <!-- Cada enlace hace una cosa diferente en el controlador -->
            <a href="index.php?sec=inicio" id="inicio" class="nav-link <?php echo $inicioActivo; ?> text-white" aria-current="page">
                Inicio
            </a>
        </li>
        <li>
            <a href="index.php?sec=clientes" id="clientes" class="nav-link <?php echo $clientesActivo; ?> text-white">
                Clientes
            </a>
        </li>
        <li>
            <a href="index.php?sec=monitores" id="monitores" class="nav-link <?php echo $monitoresActivo; ?> text-white">
                Monitores
            </a>
        </li>
        <li>
            <a href="index.php?sec=eventos" id="eventos" class="nav-link <?php echo $eventosActivo; ?> text-white">
                Eventos
            </a>
        </li>
        <?php
        //Si el dni del administrador es el que se ha definido como administrador, se mostrará el enlace a gestores
        if ($dniAdimn == '00000000A') { ?>
        <li>
            <a href="index.php?sec=gestores" id="gestores" class="nav-link <?php echo $gestoresActivo; ?> text-white">
                Gestores
            </a>
        </li>
        <?php }
        ?>
        <li>
            <form method="post">
                <button type="submit" name="cerrarSesion" class="btn btn-secondary ">Cerrar Sesión</button>
            </form>

        </li>
    </ul>
</div>
<script src="../../bootstrap/bootstrap.bundle.min.js"></script>