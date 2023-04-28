<?php 
include_once('./paginas/modales/modalCarrito.php');
?>
<img src="./css/imagenes/logo.png" alt="LogoDanzaKuduro">
<div class="parteDerecha">
    <div class="parteArriba">
        <div id="redes">
            <a href="https://www.facebook.com/" target="_blank"><i class="icofont-facebook"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="icofont-instagram"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="icofont-twitter"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="icofont-youtube-play"></i></a>
        </div>
        <?php
        if (!isset($_SESSION['usuario'])) { ?>
            <a href="paginas/inicioSesion.php" alt="registrar"><i class="icofont-user-alt-3"></i></a>
        <?php
        } else { 
            if(empty($_SESSION['carrito'])){
            ?>
            <button type="button" id="carritoVacio" name="carrito" data-bs-toggle="modal" data-bs-target="#carrito"><i class="icofont-shopping-cart"></i></button>
        <?php
            }else{ ?>
                <a><button type="button" id="carritoLleno" name="carrito" data-bs-toggle="modal" data-bs-target="#carrito"><i class="icofont-shopping-cart"></i></button></a>
            <?php

            }
        }
        ?>

    </div>
    <nav>
        <div>
            <li>
                <a href="#">Inicio</a>
            </li>
            <li>
                <a href="#">Conocenos</a>
            </li>
            <li>
                <a href="#contactanos">Contacto</a>
            </li>
            <li>
                <a href="#">Planes</a>
            </li>
            <!-- Esto sale  -->
            <?php if (isset($_SESSION['usuario'])) { ?>
                <li>
                    <a><button type="button" class="comprar" data-bs-toggle="modal" data-bs-target="#horario">Horario</button> </a>
                </li>

                <form method="post">
                    <button name="closeSesion" id="closeSesion" type="submit">Cerrar</button>
                </form>

            <?php } ?>

        </div>
    </nav>
</div>