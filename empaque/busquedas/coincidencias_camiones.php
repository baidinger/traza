<?php 
	
	$buscar = $_POST['buscar'];
	
	include("../../mod/conexion.php");
	$result_productores = mysql_query("select * from camiones_empaque
		where id_empaque_fk = ".$_SESSION['id_empaque'] ." AND (id_camion = '$buscar' OR nombre_chofer like 
		'%$buscar%')");
	if(mysql_num_rows($result_productores) > 0){
 ?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover">
	    	<thead>
		        <tr>
		          <th class="centro">#</th>
		          
		          <th class="centro">Núm. camión</th>
		          <th class="centro">Chofer</th>
		          <th class="centro">Placas</th>
		          <th class="centro">Marca</th>
		          <th class="centro">Modelo</th>
		          <th class="centro">Disponibilidad</th>
		          <th class="centro">Estado</th>
		        </tr>
      		</thead>
      		<tbody>
			<?php
			
				$i=1;
				 while($row = mysql_fetch_array($result_productores)) {
				 	
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        
			          	<td ><?php echo $row['id_camion']; ?></td>
			          	<td class="centro"><?php echo $row['nombre_chofer']; ?></td>
			         
			          	<td class="centro"><?php echo $row['placas']; ?></td>
			          	<td class="centro"><?php echo $row['marca']; ?></td>
			          	<td class="centro"><?php echo $row['modelo']; ?></td>

	          			<?php if($row['disponibilidad_ce'] == 0){ ?>
			          			<td class="centro"> <p class="label label-success"> Disponible </p> </td>
			          	<?php }else{ ?>
			          			<td class="centro"> <p class="label label-danger"> No disponible </p> </td>
			          	<?php } ?>
			          	<?php if($row['estado_ce'] == 1){ ?>
			          			<td class="centro"> <p class="label label-success"> Activo </p> </td>
			          	<?php }else{ ?>
			          			<td class="centro"> <p class="label label-danger"> Inactivo </p> </td>
			          	<?php } ?>
	          			<td class="centro">
	          				<div style="width:90px; margin:0px auto;">
		          				<a style="float:left; cursor:pointer;"> 
		          					<span onclick="editar(<?php print $row['id_camion'] ?>)"  data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Editar" class="editar glyphicon glyphicon-edit" aria-hidden="true"></span>
		          				</a>
		          				<div style="width:20px; height:10px; float:left;"></div> 
		          				<!-- ACCION HABILITAR -->
		          				<?php if($row['estado_ce'] == 1){ ?>
		          				<a style="float:left;" href="busquedas/habilitar.php?id=<?php echo $row['id_camion']; ?>&status=0&rol=3"> 
		          					<span data-toggle="tooltip" data-placement="top" title="Desactivar" class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		          				</a>
		          				<?php } else { ?>
		          				<a style="float:left;" href="busquedas/habilitar.php?id=<?php echo $row['id_distribuidor']; ?>&status=1&rol=3"> 
			          					<span data-toggle="tooltip" data-placement="top" title="Activar" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			          			</a>
		          				<?php } ?>
		          				<!--   - - - - - - - - - - - -  - - - - -  -->

		          				<div style="width:20px; height:10px; float:left;"></div> 
		          				<a style="float:left; cursor:pointer;"> 
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

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       				<h3 class="modal-title">
       					<img class="img-header" src="img/distribuidor.png"> Editar camión
       				</h3>
			      </div>
			      <div id="data-child" class="modal-body">


			      		
			        
			      </div>
			    </div>
			  </div>
			</div>

			


	<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

	<script type="text/javascript">
		//obtenerPais(<?php print $row['pais_distribuidor'] ?>)
		$('#paginacion-resultados').simplePagination();
		function editar(id){
					var params = {'id':id};
					$.ajax({
						type: 'POST',
						url: 'busquedas/editarCamion.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
						},
						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
			}
		</script>
	
