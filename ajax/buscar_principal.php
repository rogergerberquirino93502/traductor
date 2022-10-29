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
		 $aColumns = array('palabra_nueva', 'palabra_nueva');//Columnas de busqueda
		 $sTable = "traductor";
		 $aTable = "idiomas";
		 $bTable = "palabras";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
	
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
		$sql="SELECT $sTable.id_traductor ,$bTable.nombre_palabra, $sTable.palabra_nueva,
		$aTable.nombre_idioma FROM  $sTable INNER JOIN $aTable ON  $sTable.id_idioma = $aTable.id_idioma 
		INNER JOIN $bTable ON  $sTable.id_palabra= $bTable.id_palabra $sWhere LIMIT $offset,$per_page"; 
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			  <div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Palabra</th>
					<th>Traduccion</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_traductor=$row['id_traductor'];
						$nombre_palabra=$row['nombre_palabra'];
						$palabra_nueva=$row['palabra_nueva'];
		
					?>
					<tr>
						<td><?php echo $nombre_palabra; ?></td>
						<td><?php echo $palabra_nueva; ?></td>             
                        <td class="text-right">
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