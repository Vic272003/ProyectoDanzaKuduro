
<div class="modal fade" id="actualizarClase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Clase (SOLO LAS HORAS)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="./paginas/modales/funcionActualizarClase.php" method="post">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="diaActualizar">Dia</label>
                                <input type="date" class="form-control" name="diaActualizar" id="diaActualizar" readonly>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inicoActualizar">Hora Inicio</label>
                                <input type="time" class="form-control" name="inicoActualizar" id="inicoActualizar" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="finActualizar">Hora Fin</label>
                                <input type="time" class="form-control" name="finActualizar" id="finActualizar">
                            </div>

                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="actualizarClases" class="btn btn-success">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>