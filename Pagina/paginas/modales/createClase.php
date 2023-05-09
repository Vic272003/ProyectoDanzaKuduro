
<div class="modal fade" id="crearClase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Clase</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <form action="./paginas/modales/funcionCreateClase.php" method="post">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="dia">Dia</label>
                            <input type="date" class="form-control" name="diaCrear" id="dia" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inicio">Hora Inicio</label>
                            <input type="time" class="form-control" name="inicioCrear" id="inicio" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="fin">Hora Fin</label>
                            <input type="time" class="form-control" name="finCrear" id="fin">
                        </div>

                    </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="crearClases" class="btn btn-success">Añadir</button>
            </form>
        </div>
    </div>
</div>
</div>