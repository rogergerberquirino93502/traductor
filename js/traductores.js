	
		$(document).ready(function(){
			load(1);
		});
		function load(page){
			var q= $("#q").val();
			var parametros = {"action":"ajax","page":page,'q':q};
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

		$( "#guardar_traductor" ).submit(function( event ) {
			$('#guardar_datos').attr("disabled", true);
			
		   var parametros = $(this).serialize();
			   $.ajax({
					  type: "POST",
					  url: "ajax/nuevo_traductor.php",
					  data: parametros,
					   beforeSend: function(objeto){
						  $("#resultados_ajax_traductor").html("Mensaje: Cargando...");
						},
					  success: function(datos){
					  $("#resultados_ajax_traductor").html(datos);
					  $('#guardar_datos').attr("disabled", false);
					  load(1);
					}
			  });
			event.preventDefault();
		  })
		  
