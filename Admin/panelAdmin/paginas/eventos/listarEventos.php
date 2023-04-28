<?php 

$listadoEventos = Evento::listadoEventos();
$contadorFor = 0; 
$valorId;
$hora;
$dia;
$lugar;
$especialidad;
$precio;
$id;

?>
<div class="card bg-white">
    <div class="card-header align-items-center d-flex justify-content-between ">
        <h4 class="card-title mb-0 ">Eventos</h4>

        <form method="post" class="row g-3 align-items-center d-flex justify-content-between">
            <div class="col-auto">
                <label for="inputAnio" class="visually-hidden">Buscar por año</label>
                <input type="text" class="form-control" name="inputAnio" id="inputAnio" placeholder="Buscar por año">
            </div>
            <div class="col-auto">
                <button type="submit" name="buscarAnio" class="btn btn-success btn-sm ps-3 pe-3">Buscar</button>
            </div>
        </form>

        <button type="submit" data-bs-toggle="modal" data-bs-target="#crearEvento" name="crearEvento" class="btn btn-success btn-sm">Añadir Evento</button>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead class="table-light">
                <tr>
                    <?php
                    //Hacemos un forEach para recoger una sola vez los atributos del eventos
                    foreach ($listadoEventos as $eventos) {

                        if ($contadorFor == 0) {
                            //Hacemos un segundo foreach para recoger su atributo
                            foreach ($eventos as $atributo => $valor) {
                                if ($atributo != 'id') { ?>
                                    <th scope="col"><?php echo strtoupper($atributo) ?></th>
                    <?php }
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
                //Este foreach recorre los diferentes Monitors
                foreach ($listadoEventos as $eventos) { ?>
                    <tr>
                        <?php
                        //Este segundo foreach mostrará el valor de cada eventos
                        foreach ($eventos as $atributo => $valor) {
                            if ($atributo != 'id') { ?>
                                <td><?php echo $valor ?></td>
                            <?php }else{
                                $valorId=$valor;
                            }
                            if($atributo == 'dia'){
                                $dia=$valor;
                            }
                            if($atributo == 'hora'){
                                $hora=$valor;
                            }
                            if($atributo == 'lugar'){
                                $lugar=$valor;
                            }
                            if($atributo == 'especialidad'){
                                $especialidad=$valor;
                            }
                            if($atributo == 'precio'){
                                $precio=$valor;
                            }
                            if($atributo == 'id'){
                                $id=$valor;
                            }
                            ?>



                        <?php } ?>
                        <form method="post">
                            <!-- Este input recoge el id de cada Evento para luego poder recogerlo -->
                            <input type="hidden" value="<?php echo $valorId ?>" name="sacarIdEvento">
                            <td>
                                <!-- Se harán modificaciones  -->
                                <button  data-dia="<?php echo $dia;?>" data-hora="<?php echo $hora;?>" data-precio="<?php echo $precio;?>" data-lugar="<?php echo $lugar;?>" data-id="<?php echo $id;?>" data-especialidad="<?php echo $especialidad;?>" type="button" name="botonMod" class="icono botonMod" style="background-color: transparent;" data-bs-toggle="modal" data-bs-target="#actualizararEvento"><i class="icofont-options icono"></i></button>

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