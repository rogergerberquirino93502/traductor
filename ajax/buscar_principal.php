<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_evidencia=intval($_GET['id']);
		if ($delete1=mysqli_query($con,"DELETE FROM evidencias WHERE id_evidencia='".$id_evidencia."'")){
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		 
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		
		 $aColumns = array('codigo_proceso', 'numero_indicio');//Columnas de busqueda
		 $sTable = "evidencias";
		 $aTable = "bodegas";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
		
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 18; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './evidencias.php';
		//main query to fetch the data
		$sql="SELECT $sTable.id_evidencia, $sTable.date_added, $sTable.codigo_proceso, $sTable.numero_indicio, 
		$aTable.nombre_bodega FROM  $sTable INNER JOIN $aTable ON  $sTable.id_bodega = $aTable.id_bodega 
		$sWhere LIMIT $offset,$per_page";
		//$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			  <div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Proceso</th>
					<th>Indicio</th>
					<th>Bodega</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_evidencia=$row['id_evidencia'];
						$codigo_proceso=$row['codigo_proceso'];
						$fecha=date("d/m/Y", strtotime($row['date_added']));
						$numero_indicio=$row['numero_indicio'];
						$nombre_bodega=$row['nombre_bodega'];
					?>
					<tr>
                        <td><?php echo $numero_indicio; ?></td>
                        <td><?php echo $fecha; ?></td>
						<td><?php echo $codigo_proceso; ?></td>
						<td><?php echo $numero_indicio; ?></td>
						<td><?php echo $nombre_bodega; ?></td>
         

                    </tr>
					<?php
			
				}
				?>
				</table>
				<div class="clearfix"></div>
				<div class='row text-center'>
					<div ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></div>
				
				</div>
			
			<?php
		}
	}
?>
