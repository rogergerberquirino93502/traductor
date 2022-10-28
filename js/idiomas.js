$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/buscar_idiomas.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            
        }
    })
}

$( "#guardar_idiomas" ).submit(function( event ) {
$('#guardar_datos').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
    type: "POST",
    url: "ajax/nuevo_idioma.php",
    data: parametros,
     beforeSend: function(objeto){
        $("#resultados_ajax").html("Mensaje: Cargando...");
      },
    success: function(datos){
    $("#resultados_ajax").html(datos);
    $('#guardar_datos').attr("disabled", false);
    load(1);
  }
});
event.preventDefault();
})

$( "#editar_idioma" ).submit(function( event ) {
$('#actualizar_datos').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
    type: "POST",
    url: "ajax/editar_idioma.php",
    data: parametros,
     beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
      },
    success: function(datos){
    $("#resultados_ajax2").html(datos);
    $('#actualizar_datos').attr("disabled", false);
    load(1);
  }
});
event.preventDefault();
})


$('#myModal2').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) // Button that triggered the modal
var nombre = button.data('nombre') 
var descripcion = button.data('descripcion') 
var id = button.data('id') 
var modal = $(this)
modal.find('.modal-body #mod_nombre').val(nombre)
modal.find('.modal-body #mod_descripcion').val(descripcion) 
modal.find('.modal-body #mod_id').val(id)
})


