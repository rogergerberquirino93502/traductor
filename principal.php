<?php
    $active_principal="active";
	$title="Traductor | Inicio";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>

  </head>
  <body>
	<?php
	include("navbar.php");
	?>
    <div class="container">
		<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Diccionario de Idioma</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_evidencia">

						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Lista de Traducciones</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Ingrese la consulta" onkeyup='load(1);'>
							</div>



							<div class="col-md-3">
								<button type="button" class="btn btn-success" onclick='load(1);'>
									<span></span> Buscar</button>
								<span id="loader"></span>
							</div>

						</div>



			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/principal.js"></script>
  </body>
</html>