<?php

$listadoEventosAnio = Evento::listadoEventosPorAnio($_POST['inputAnio']);
$contadorFor = 0;
?>
<div class="card bg-white">
    <div class="card-header align-items-center d-flex justify-content-between ">
        <h4 class="card-title mb-0 ">Eventos por Año</h4>
        <form method="post">
            <button type="submit" name="atras" class="btn btn-success btn-sm">Atras</button>
        </form>

    </div>
    <div class="card-body">
        <?php
        if ($listadoEventosAnio == false) {
            echo "<strong>No se han encontrado resultados</strong>";
        } else { ?>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <?php
                        $contadorFor = 0;
                        //Hacemos un forEach para recoger una sola vez los atributos del eventos
                        foreach ($listadoEventosAnio as $eventos) {

                            if ($contadorFor == 0) {
                                //Hacemos un segundo foreach para recoger su atributo
                                foreach ($eventos as $atributo => $valor) { ?>
                                    <th scope="col"><?php echo strtoupper($atributo) ?></th>
                        <?php

                                }
                            }
                            $contadorFor = 100;
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Este foreach recorre los diferentes Monitors
                    foreach ($listadoEventosAnio as $eventos) { ?>
                        <tr>
                            <?php
                            //Este segundo foreach mostrará el valor de cada eventos
                            foreach ($eventos as $atributo => $valor) {
                            ?>

                                <td><?php echo $valor ?></td>

                            <?php } ?>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        <?php }
        ?>
    </div>
</div>