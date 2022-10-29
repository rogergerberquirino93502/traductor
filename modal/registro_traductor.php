	<?php
		if (isset($con))
		{
	?>
	<div class="modal fade" id="nuevoTraductor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nueva traductor</h4>
		  </div>
		  <div class="modal-body">
		  <div class="form-group" align="center">	
			  </div>
			<form class="form-horizontal" method="post" id="guardar_traductor" name="guardar_traductor">
			<div id="resultados_ajax_traductores"></div>
			<div class="form-group">
				<label for="palabra" class="col-sm-3 control-label">Palabras</label>
				<div class="col-sm-8">
					<select class='form-control' name='palabra' id='palabra' required>
						<option value="">Seleccionar Palabra</option>
							<?php 
							$query_palabra=mysqli_query($con,"select * from palabras order by nombre_palabra");
							while($rw=mysqli_fetch_array($query_palabra))	{
								?>
							<option value="<?php echo $rw['id_palabra'];?>"><?php echo $rw['nombre_palabra'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="palabra_nueva" class="col-sm-3 control-label">Palabra Nueva</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="palabra_nueva" name="palabra_nueva" placeholder="Palabra Nueva" required>	  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="idioma" class="col-sm-3 control-label">Idiomas</label>
				<div class="col-sm-8">
					<select class='form-control' name='idioma' id='idioma' required>
						<option value="">Seleccionar un Idioma</option>
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
			  </div>
		 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-success" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>