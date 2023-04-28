<?php 
session_start();
if (!isset($_SESSION['dni'])) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../ficheroJquery.js" type="text/javascript"></script>
    <script src="../css/controlarMenu.js" type="text/javascript"></script> 
    <link rel="stylesheet" type="text/css" href="../../icofont/icofont.min.css">
    <link rel="stylesheet" type="text/css" href="../../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/clientes.css">
    <script src="./chart.js"></script>
    
    <title>Document</title>
<style>
    .informacion{
        background-color: #F3F3F9;
    }
</style>
</head>
<?php
    require_once('../controlador/controlador.php');
?>
<body class="bg-dark">
<div class="container-fluid m-0 ">
        <div class="row">
            <div class="col-2 p-0 h-100">
                <?php 
                    //Llama
                    require_once('./menu.php');
                ?>
            </div>
            <div class="col pt-5  informacion">
            <?php   
                //Inicia la página que le pasamos por el controlador
                require_once($pagina);
                ?>
            </div>
            
        </div>
</div>
    <script src="../../bootstrap/bootstrap.bundle.min.js" ></script>
</body>
</html>