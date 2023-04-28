<div class="modal" id="carrito">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Cabecera del modal -->
            <div class="modal-header">
                <h5 class="modal-title text-danger">Carrito de la compra</h5>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <!-- Contenido del modal -->
            <div class="modal-body">
                <?php
                if (isset($_SESSION['carrito'])) {
                    $carrito = $_SESSION['carrito'];
                    
                    foreach ($carrito as $key => $value) {
                        if($key=='eventos'){
                            echo "<p>Eventos:</p>";
                            foreach ($value as $evento) {
                                echo "<p>$evento</p>";
                            }
                        }else{
                            echo "<p>$key: $value</p>";
                        }
                    }
                } else {
                    echo "<p>El carrito está vacío</p>";
                }
                ?>
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>