$(document).ready(function(){


    $('.botonMod').click(function(){
        let dni = $(this).attr('data-dni');
        let nombre = $(this).attr('data-nombre');
        let apellidos = $(this).attr('data-apellidos');
        let dia=$(this).attr('data-dia');
        let hora=$(this).attr('data-hora');
        let precio=$(this).attr('data-precio');
        let lugar=$(this).attr('data-lugar');
        let especialidad=$(this).attr('data-especialidad');
        let id=$(this).attr('data-id');

        $("#dniActualizar").val(dni);
        $("#nombreActualizar").val(nombre);
        $("#apellidosActualizar").val(apellidos);
        $("#apellidosActualizar").val(apellidos);
        $("#diaActualizar").val(dia);
        $("#horaActualizar").val(hora);
        $("#precioActualizar").val(precio);
        $("#lugarActualizar").val(lugar);
        $("#especialidadActualizar").val(especialidad);
        $("#idActualizar").val(id);
    });
});