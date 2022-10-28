<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
	if (isset($_FILES['fotoi']['name'])) {
		$tamano_archivo = $_FILES['fotoi']['size'];
		$imagenSubida = fopen($_FILES['fotoi']['tmp_name'], 'r');
		$binariosImagen = fread($imagenSubida, $tamano_archivo);
	
	if (empty($_POST['palabrae'])) {
           $errors[] = "Palabra vacío";
        } else if (empty($_POST['palabran'])){
			$errors[] = "Palabra nueva vacío";
		} else if ($_POST['idioma']==""){
			$errors[] = "Idioma vacío";
		}  else if (
			!empty($_POST['palabrae']) &&
			!empty($_POST['palabran']) &&
			$_POST['idioma']!="" &&
			!empty($_POST['idioma'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include("../funciones.php");
		// escaping, additionally removing everything that could be (html/javascript-) code
		$palabrae=mysqli_real_escape_string($con,(strip_tags($_POST["palabrae"],ENT_QUOTES)));
		$palabran=mysqli_real_escape_string($con,(strip_tags($_POST["palabran"],ENT_QUOTES)));
		$id_idioma=intval($_POST['idioma']);
		$date_added=date("Y-m-d H:i:s");
		$binariosImagen = mysqli_real_escape_string($con,$binariosImagen);

		
		$sql="INSERT INTO traductor (palabra_espaniol, palabra_nueva, date_added, id_idioma, imagen) VALUES ('$palabrae','$palabran','$date_added', '$id_idioma', '$binariosImagen')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Traduccion ha sido ingresado satisfactoriamente.";
								
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} }else {
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