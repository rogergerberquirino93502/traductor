	
		$(document).ready(function(){
			load(1);
		});
		function load(page){
			var q= $("#q").val();
			var id_idioma= $("#id_idioma").val();
			var parametros = {"action":"ajax","page":page,'id_idioma':id_idioma,'q':q};
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_traductor.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
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
		
		$( "#guardar_traductor" ).submit(function( event ) {
			$('#guardar_datos').attr("disabled", true);
		  
		   var palabra_espaniol = $("#palabra_espaniol").val(); 
		   var palabra_nueva = $("#palabra_nueva").val();
		   var idioma = $("#idioma").val();
		   var imagen = $("#imagen").val();
			  if(palabra_espaniol.lenght == 0 || palabra_nueva.lenght == 0 || idioma.lenght == 0){
				  return $wal.fire("Mensaje de Advertencia", "Debe llenar todos los campos", "warning");
			  }if(imagen.lenght == 0){
				  return $wal.fire("Mensaje de Advertencia", "Debe seleccionar una imagen", "warning");
			  }
			  var formData = new FormData();
			  var foto = $("#imagen")[0].files[0];
			  formData.append("palabrae", palabra_espaniol);
			  formData.append("palabran", palabra_nueva);
			  formData.append("idioma", idioma);
			  formData.append("fotoi", foto);
		  
			   $.ajax({
					  type: "POST",
					  url: "ajax/nuevo_traductor.php",
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
		  
	
		
		
		
		
		
		
		
		

