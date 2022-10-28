		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_imagenes.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
				}
			})
		}

		
		
	function eliminar (id)
		{
		var q= $("#q").val();
		if (confirm("Realmente deseas eliminar la imagen")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_imagenes.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}
//VISUALIZAR IMAGENES
		document.getElementById("imagen").addEventListener("change", () => {
            var archivoseleccionado = document.querySelector("#imagen");
            var archivos = archivoseleccionado.files;
            var imagenPrevisualizacion = document.querySelector("#mostrarimagen");
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
            imagenPrevisualizacion.src = "";
            return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            var primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            var objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            imagenPrevisualizacion.src = objectURL;
        });
		
	




$( "#guardar_imagenes" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var evidencia = $("#evidencia").val(); 
 var nombre = $("#nombre").val();
 var tipo = $("#tipo").val();
 var imagen = $("#imagen").val();
	if(evidencia.lenght == 0 || nombre.lenght == 0 || tipo.lenght == 0){
		return $wal.fire("Mensaje de Advertencia", "Debe llenar todos los campos", "warning");
	}if(imagen.lenght == 0){
		return $wal.fire("Mensaje de Advertencia", "Debe seleccionar una imagen", "warning");
	}
	var formData = new FormData();
	var foto = $("#imagen")[0].files[0];
	formData.append("evidenciai", evidencia);
	formData.append("nombrei", nombre);
	formData.append("tipoi", tipo);
	formData.append("fotoi", foto);

	 $.ajax({
			type: "POST",
			url: "ajax/nueva_imagenes.php",
			data: formData,
			contentType: false,
			processData: false,
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








$( "#editar_categoria" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_imagenes.php",
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
	  var evidencia = button.data('evidencia')
	  var nombre = button.data('nombre') 
	  var tipo = button.data('tipo')
	  var imagen = button.data('imagen') 
	  var id = button.data('id') 
	  var modal = $(this)
	  modal.find('.modal-body #evidencia').val(evidencia)
	  modal.find('.modal-body #mod_nombre').val(nombre)
	  modal.find('.modal-body #mod_tipo').val(tipo)
	  modal.find('.modal-body #mod_imagen').val(imagen) 
	  modal.find('.modal-body #mod_id').val(id)
	})
		

