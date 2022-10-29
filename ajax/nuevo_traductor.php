<?php		
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['palabra'])) {
           $errors[] = "Palabra vacío";
        } else if (empty($_POST['palabra_nueva'])){
			$errors[] = "Palabra Vacío";
		} else if ($_POST['idioma']==""){
			$errors[] = "Idioma Vacío";
		}  else if (
			!empty($_POST['palabra']) &&
			!empty($_POST['palabra_nueva']) &&
			!empty($_POST['idioma'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include("../funciones.php");
		// escaping, additionally removing everything that could be (html/javascript-) code

		$palabra_nueva=mysqli_real_escape_string($con,(strip_tags($_POST["palabra_nueva"],ENT_QUOTES)));
		$id_palabra=intval($_POST['palabra']);
		$id_idioma=intval($_POST['idioma']);
		
		$sql="INSERT INTO traductor (id_palabra, palabra_nueva, id_idioma) VALUES ('$id_palabra','$palabra_nueva','$id_idioma')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Traduccion ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>