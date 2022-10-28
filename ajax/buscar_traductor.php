<?php

	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_traductor=intval($_GET['id']);
		if ($delete1=mysqli_query($con,"DELETE FROM traductor WHERE id_traductor='".$id_traductor."'")){
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
		 $id_idioma =intval($_REQUEST['id_idioma']);
		 $aColumns = array('palabra_espaniol', 'palabra_nueva');//Columnas de busqueda
		 $sTable = "traductor";
		 $aTable = "idiomas";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
		if ($id_idioma>0){
			$sWhere .=" and id_idioma='$id_idioma'";
		}
		$sWhere.=" order by id_traductor desc";
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
		$reload = './traductor.php';
		//main query to fetch the data
		$sql="SELECT $sTable.id_traductor, $sTable.palabra_espaniol, $sTable.palabra_nueva, 
		 $sTable.imagen, $sTable.date_added, $aTable.nombre_idioma FROM  $sTable INNER JOIN $aTable ON  $sTable.id_idioma = $aTable.id_idioma 
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
					<th>En Español</th>
					<th>Traducido</th>
					<th>Idioma</th>
					<th>Imagen</th>
					<th>Fecha</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_traductor=$row['id_traductor'];
						$palabra_espaniol=$row['palabra_espaniol'];
						$palabra_nueva=$row['palabra_nueva'];
						$nombre_idioma=$row['nombre_idioma'];
						$imagen=$row['imagen'];
						$fecha=date("d/m/Y", strtotime($row['date_added']));
						
					?>
					<tr>
						<td><?php echo $palabra_espaniol; ?></td>
						<td><?php echo $palabra_nueva; ?></td>
						<td><?php echo $nombre_idioma; ?></td>
						<td id="example1"><?php echo '<img class="zoom" src="data:image/jpeg;base64,'.base64_encode($imagen).'" class="card-img-top" width="300" height="300"/>';?></td>
						<td><?php echo $fecha; ?></td>
						<td class="text-right">
                            <a href="editar_evidencia.php?id_evidencia=<?php echo $id_evidencia;?>" class='btn btn-default' title='Editar Evidencia' data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="#" class='btn btn-default' title='Descargar Evidencia' onclick="imprimir_factura('<?php echo $id_evidencia;?>');"><i class="glyphicon glyphicon-download"></i></a>
                        </td>

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
