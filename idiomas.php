<?php
	require_once ("config/db.php");
	require_once ("config/conexion.php");
	
	$active_idiomas="active";
	$title="Idiomas ";
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
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoIdioma"><span class="glyphicon glyphicon-plus" ></span> Nuevo Idioma</button>
			</div>
			<h4><i class='glyphicon glyphicon-briefcase'></i> Listado de Idioma</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
				include("modal/registro_idioma.php");
				include("modal/editar_idioma.php");
			?>
			<form class="form-horizontal" role="form">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombre</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre de Idioma" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-success" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
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
	<script type="text/javascript" src="js/idiomas.js"></script>
  </body>
</html>
