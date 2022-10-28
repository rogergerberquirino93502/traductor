<?php
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	$active_traductor="active";
	$title="Traductor ";
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
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoTraductor"><span class="glyphicon glyphicon-plus" ></span> Agregar</button>
			</div>
			<h4><i class='glyphicon glyphicon-floppy-open'></i> Consultar Traductor</h4>
		</div>
		<div class="panel-body">								
			<?php
			include("modal/registro_traductor.php");
			?>
			<form class="form-horizontal" role="form" id="datos">						
				<div class="row">
					<div class='col-md-4'>
						<label>Ingresar Palabra</label>
						<input type="text" class="form-control" id="q" placeholder="Ingresar Palabra" onkeyup='load(1);'>
					</div>
					<div class='col-md-4'>
						<label>Filtrar por idioma</label>
						<select class='form-control' name='id_idioma' id='id_idioma' onchange="load(1);">
							<option value="">Selecciona un idioma</option>
							<?php 
							$query_idioma=mysqli_query($con,"select * from idiomas order by nombre_idioma");
							while($rw=mysqli_fetch_array($query_idioma))	{
								?>
							<option value="<?php echo $rw['id_idioma'];?>"><?php echo $rw['nombre_idioma'];?></option>			
								<?php
							}
							?>
						</select>
					</div>
					<div class='col-md-12 text-center'>
						<span id="loader"></span>
					</div>
				</div>
				<hr>
				<div class='row-fluid'>
					<div id="resultados"></div><!-- Carga los datos ajax -->
				</div>	
				<div class='row'>
					<div class='outer_div'></div><!-- Carga los datos ajax -->
				</div>
			</form>			
  </div>
</div>
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/traductores.js"></script>
  </body>
</html>
<script>
