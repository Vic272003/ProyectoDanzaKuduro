$(document).ready(function(){


    $('.botonModClase').click(function(){

        let dia = $(this).attr('data-dia');

        let inicio = $(this).attr('data-inicio');
        let fin = $(this).attr('data-fin');
        
        $("#diaActualizar").val(dia);
        $("#inicoActualizar").val(inicio);
        $("#finActualizar").val(fin);
        
    });
});