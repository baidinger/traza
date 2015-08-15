<?php 
	
	$buscar = $_POST['buscar'];
	
	include("../../mod/conexion.php");
	$result_productores = mysql_query("select id_distribuidor, nombre_distribuidor, rfc_distribuidor, ".
		"pais_distribuidor, estado_distribuidor, ciudad_distribuidor, direccion_distribuidor, cp_distribuidor, ".
		" email_distribuidor, tel1_distribuidor, tel2_distribuidor, estado_d from empresa_distribuidores
		where id_usuario_que_registro = ".$_SESSION['id_usuario'] ." AND nombre_distribuidor like 
		'%$buscar%'");
	if(mysql_num_rows($result_productores) > 0){
 ?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover" style="font-size: 14px">
	    	<thead>
		        <tr>
		          <th class="centro">#</th>
		          <th class="centro">ID</th>
		          <th>Nombre</th>
		          <th class="centro">RFC</th>
		          <th class="centro">Ubicación</th>
		          <th class="centro">Teléfono</th>
		          <th class="centro">Estado</th>
		          <th class="centro"></th>
		        </tr>
      		</thead>
      		<tbody>
			<?php
			
				$i=1;
				 while($row = mysql_fetch_array($result_productores)) {
				 	
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        		<td class="centro"><a href="index.php?distribuidor=<?php print $row['id_distribuidor'] ?>"> <?php echo str_pad($row['id_distribuidor'], 7,"0",STR_PAD_LEFT); ?> </a></td>
			          	<td > <a href="index.php?distribuidor=<?php print $row['id_distribuidor'] ?>"> <?php echo $row['nombre_distribuidor']; ?></a></td>
			          	<td class="centro"><?php echo $row['rfc_distribuidor']; ?></td>
			          	<td class="centro"><?php echo "<span class='label label-info'>$row[ciudad_distribuidor]</span>";

			          	$paises = array("MEXICO","ESTADOS UNIDOS","CANADÁ","JAPÓN","AUSTRALIA");
			          	
			          	$pais_c = $row['pais_distribuidor'];
			          	$estado_c = $row['estado_distribuidor'];

			          	print ", ";

			          	$mexico = array("AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS");
			          	$eua = array("ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING");
			          	$canada = array("ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5");
			          	$japon = array("PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA");
			          	$australia = array("NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA");

			          	switch ($pais_c) {
			          		case '0':
			          			print "<span class='label label-info'>$mexico[$estado_c]</span>";
			          			break;
			          			case '1':
			          			print "<span class='label label-info'>$eua[$estado_c]</span>";
			          			break;
			          			case '2':
			          			print "<span class='label label-info'>$canada[$estado_c]</span>";
			          			break;
			          			case '3':
			          			print "<span class='label label-info'>$japon[$estado_c]</span>";
			          			break;
			          			case '4':
			          			print "<span class='label label-info'>$australia[$estado_c]</span>";
			          			break;
			          	}

			          	print ", <span class='label label-success'>$paises[$pais_c]</span>";

			          	 ?></td>
			          	<td class="centro"><?php echo $row['tel1_distribuidor']; ?></td>

	          			<?php if($row['estado_d'] == 1){ ?>
			          			<td class="centro"> <p class="label label-success"> Activo </p> </td>
			          	<?php }else{ ?>
			          			<td class="centro"> <p class="label label-danger"> Inactivo </p> </td>
			          	<?php } ?>
	          			<td class="centro">
	          				<div style="width:70px; margin:0px; float: right">
		          				<a href="index.php?op=editar_dist&id=<?php print $row['id_distribuidor'] ?>" style="float:left; "> 
		          					<span data-toggle="tooltip" data-placement="top" title="Editar" class="editar glyphicon glyphicon-edit" aria-hidden="true"></span>
		          				</a>
		          				<div style="width:10px; height:10px; float:left;"></div> 
		          				<!-- ACCION HABILITAR -->
		          				<?php if($row['estado_d'] == 1){ ?>
		          				<a style="float:left;" href="busquedas/habilitar.php?id=<?php echo $row['id_distribuidor']; ?>&status=0&rol=3"> 
		          					<span data-toggle="tooltip" data-placement="top" title="Desactivar" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		          				</a>
		          				<?php } else { ?>
		          				<a style="float:left;" href="busquedas/habilitar.php?id=<?php echo $row['id_distribuidor']; ?>&status=1&rol=3"> 
			          					<span data-toggle="tooltip" data-placement="top" title="Activar" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			          			</a>
		          				<?php } ?>
		          				<!--   - - - - - - - - - - - -  - - - - -  -->

		          				<div style="width:10px; height:10px; float:left;"></div> 
		          				<a href="index.php?distribuidor=<?php print $row['id_distribuidor'] ?>" style="float:left; cursor:pointer;"> 
		          					<span data-toggle="tooltip" data-placement="top" title="Ver Info." class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		          				</a>
	          				</div>
	          			</td>
		        	</tr>
		        <?php  
		        $i=$i+1;
				 }
			
			  ?>
          	</tbody>
        </table>

        	<?php if($i > 1){ ?>
					<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
					</div>
				<?php } ?>

		</div>

        <?php 
    }else{
    	 ?>
		    	 <br><br>
		    	 <br>
		    	 	<div style="width:500px; margin:0px auto;" class="alert alert-info centro" role="alert"> 
		    	 		<strong>No se encontraron DISTRIBUIDORES registrados.</strong>
		    	 	</div>
		    	 	<br><br>
		    	<?php
    }
			
		?>

			

			


	<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

	<script type="text/javascript">
		$('#paginacion-resultados').simplePagination();
		$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
		</script>
	
