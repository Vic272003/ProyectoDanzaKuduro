<div class="container">
    <div class="row">
        <div class="col-6">
            <canvas id="graficaActual"></canvas>
        </div>
        <div class="col-6">
            <canvas id="graficaAntes"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <canvas id="graficaEventosActual"></canvas>
        </div>
        <div class="col-6">
            <canvas id="graficaEventosAntes"></canvas>
        </div>
    </div>
</div>


<?php

include_once('../clases/cliente.php');
include_once('../clases/evento.php');
//Sacamos la fecha actual y de 2021
$fechaActual = date('Y');
$fechaAnterior = date('Y') - 2;


//Listamos los clientes pasando por parámetro la fecha
$listarClientesFechaActual = Cliente::listaClienteFechasAlta($fechaActual);
$listarClientesFechaAnterior = Cliente::listaClienteFechasAlta($fechaAnterior);

//Listamos los eventos pasando por parámetro la fecha
$listarEventosFechaActual = Evento::listaEventosYear($fechaActual);
$listarEventosFechaAnterior = Evento::listaEventosYear($fechaAnterior);

//Creamos un array de fechas
$arrayMesesActual = [
    "Enero" => 0,
    "Febrero" => 0,
    "Marzo" => 0,
    "Abril" => 0,
    "Mayo" => 0,
    "Junio" => 0,
    "Julio" => 0,
    "Agosto" => 0,
    "Septiembre" => 0,
    "Octubre" => 0,
    "Noviembre" => 0,
    "Diciembre" => 0
];
$arrayMesesAnterior = $arrayMesesActual;

$arrayMesesEventosYearActual = $arrayMesesActual;         //Le asociamos el array a todos

$arrayMesesEventosYearAnterior = $arrayMesesActual;

//Recorre los clientes del año actual
if ($listarClientesFechaActual) {
    foreach ($listarClientesFechaActual as $fechas) {
        foreach ($fechas as $atributo => $fecha) {
            $mesFecha = date('m', strtotime($fecha));
            switch ($mesFecha) {
                case 01:
                    $arrayMesesActual['Enero'] += 1;
                    break;
                case 02:
                    $arrayMesesActual['Febrero'] += 1;
                    break;
                case 03:
                    $arrayMesesActual['Marzo'] += 1;
                    break;
                case 04:
                    $arrayMesesActual['Abril'] += 1;
                    break;
                case 05:
                    $arrayMesesActual['Mayo'] += 1;
                    break;
                case 06:
                    $arrayMesesActual['Junio'] += 1;
                    break;
                case 07:
                    $arrayMesesActual['Julio'] += 1;
                    break;
                case 8:
                    $arrayMesesActual['Agosto'] += 1;
                    break;
                case 9:
                    $arrayMesesActual['Septiembre'] += 1;
                    break;
                case 10:
                    $arrayMesesActual['Octubre'] += 1;
                    break;
                case 11:
                    $arrayMesesActual['Noviembre'] += 1;
                    break;
                case 12:
                    $arrayMesesActual['Diciembre'] += 1;
                    break;
            }
        }
    }
}

//Recorre los clientes del año anterior
if ($listarClientesFechaAnterior) {
    foreach ($listarClientesFechaAnterior as $fechas) {
        foreach ($fechas as $atributo => $fecha) {
            $mesFecha = date('m', strtotime($fecha));
            switch ($mesFecha) {
                case 01:
                    $arrayMesesAnterior['Enero'] += 1;
                    break;
                case 02:
                    $arrayMesesAnterior['Febrero'] += 1;
                    break;
                case 03:
                    $arrayMesesAnterior['Marzo'] += 1;
                    break;
                case 04:
                    $arrayMesesAnterior['Abril'] += 1;
                    break;
                case 05:
                    $arrayMesesAnterior['Mayo'] += 1;
                    break;
                case 06:
                    $arrayMesesAnterior['Junio'] += 1;
                    break;
                case 07:
                    $arrayMesesAnterior['Julio'] += 1;
                    break;
                case 8:
                    $arrayMesesAnterior['Agosto'] += 1;
                    break;
                case 9:
                    $arrayMesesAnterior['Septiembre'] += 1;
                    break;
                case 10:
                    $arrayMesesAnterior['Octubre'] += 1;
                    break;
                case 11:
                    $arrayMesesAnterior['Noviembre'] += 1;
                    break;
                case 12:
                    $arrayMesesAnterior['Diciembre'] += 1;
                    break;
            }
        }
    }
}


//Recorre los eventos del año actual
if ($listarEventosFechaActual) {
    foreach ($listarEventosFechaActual as $fechas) {
        foreach ($fechas as $atributo => $fecha) {
            $mesFecha = date('m', strtotime($fecha));
            switch ($mesFecha) {
                case 01:
                    $arrayMesesEventosYearActual['Enero'] += 1;
                    break;
                case 02:
                    $arrayMesesEventosYearActual['Febrero'] += 1;
                    break;
                case 03:
                    $arrayMesesEventosYearActual['Marzo'] += 1;
                    break;
                case 04:
                    $arrayMesesEventosYearActual['Abril'] += 1;
                    break;
                case 05:
                    $arrayMesesEventosYearActual['Mayo'] += 1;
                    break;
                case 06:
                    $arrayMesesEventosYearActual['Junio'] += 1;
                    break;
                case 07:
                    $arrayMesesEventosYearActual['Julio'] += 1;
                    break;
                case 8:
                    $arrayMesesEventosYearActual['Agosto'] += 1;
                    break;
                case 9:
                    $arrayMesesEventosYearActual['Septiembre'] += 1;
                    break;
                case 10:
                    $arrayMesesEventosYearActual['Octubre'] += 1;
                    break;
                case 11:
                    $arrayMesesEventosYearActual['Noviembre'] += 1;
                    break;
                case 12:
                    $arrayMesesEventosYearActual['Diciembre'] += 1;
                    break;
            }
        }
    }
}


//Recorre los Eventos del año anterior
if ($listarEventosFechaAnterior) {
    foreach ($listarEventosFechaAnterior as $fechas) {
        foreach ($fechas as $atributo => $fecha) {
            $mesFecha = date('m', strtotime($fecha));
            switch ($mesFecha) {
                case 01:
                    $arrayMesesEventosYearAnterior['Enero'] += 1;
                    break;
                case 02:
                    $arrayMesesEventosYearAnterior['Febrero'] += 1;
                    break;
                case 03:
                    $arrayMesesEventosYearAnterior['Marzo'] += 1;
                    break;
                case 04:
                    $arrayMesesEventosYearAnterior['Abril'] += 1;
                    break;
                case 05:
                    $arrayMesesEventosYearAnterior['Mayo'] += 1;
                    break;
                case 06:
                    $arrayMesesEventosYearAnterior['Junio'] += 1;
                    break;
                case 07:
                    $arrayMesesEventosYearAnterior['Julio'] += 1;
                    break;
                case 8:
                    $arrayMesesEventosYearAnterior['Agosto'] += 1;
                    break;
                case 9:
                    $arrayMesesEventosYearAnterior['Septiembre'] += 1;
                    break;
                case 10:
                    $arrayMesesEventosYearAnterior['Octubre'] += 1;
                    break;
                case 11:
                    $arrayMesesEventosYearAnterior['Noviembre'] += 1;
                    break;
                case 12:
                    $arrayMesesEventosYearAnterior['Diciembre'] += 1;
                    break;
            }
        }
    }
}

?>

<script>
    const ctx = document.getElementById('graficaActual');
    //Vamos a crear una gráfica para el año actual de cliente
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php
                        foreach ($arrayMesesActual as $key => $value) { ?> '<?php echo $key ?>',
                <?php
                        } ?>
            ],
            datasets: [{
                label: 'Usuarios (por unidad) <?php echo $fechaActual ?>',
                data: [<?php
                        foreach ($arrayMesesActual as $key => $value) { ?> '<?php echo $value ?>',
                    <?php
                        } ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    //Vamos a crear una gráfica para el año anterior de clientes
    const ctl = document.getElementById('graficaAntes');
    new Chart(ctl, {
        type: 'line',
        data: {
            labels: [<?php
                        foreach ($arrayMesesAnterior as $key => $value) { ?> '<?php echo $key ?>',
                <?php
                        } ?>
            ],
            datasets: [{
                label: 'Usuarios (por unidad) <?php echo $fechaAnterior ?>',
                data: [<?php
                        foreach ($arrayMesesAnterior as $key => $value) { ?> '<?php echo $value ?>',
                    <?php
                        } ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    //Vamos a crear una gráfica para el año anterior de Eventos
    const ctp = document.getElementById('graficaEventosActual');
    new Chart(ctp, {
        type: 'bar',
        data: {
            labels: [<?php
                        foreach ($arrayMesesEventosYearActual as $key => $value) { ?> '<?php echo $key ?>',
                <?php
                        } ?>
            ],
            datasets: [{
                label: 'Eventos (por mes) <?php echo $fechaActual ?>',
                data: [<?php
                        foreach ($arrayMesesEventosYearActual as $key => $value) { ?> '<?php echo $value ?>',
                    <?php
                        } ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    //Vamos a crear una gráfica para el año anterior de Eventos
    const ctq = document.getElementById('graficaEventosAntes');
    new Chart(ctq, {
        type: 'line',
        data: {
            labels: [<?php
                        foreach ($arrayMesesEventosYearAnterior as $key => $value) { ?> '<?php echo $key ?>',
                <?php
                        } ?>
            ],
            datasets: [{
                label: 'Eventos (por mes) <?php echo $fechaAnterior ?>',
                data: [<?php
                        foreach ($arrayMesesEventosYearAnterior as $key => $value) { ?> '<?php echo $value ?>',
                    <?php
                        } ?>
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>