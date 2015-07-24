<?php
			include("../../mod/conexion.php");
			$buscar = $_POST['buscar'];
			$result_productores = mysql_query("select id_productor, nombre_productor, apellido_productor, ".
				"telefono_productor, direccion_productor, ".
				" rfc_productor, id_usuario_fk, estado, nombre_usuario from empresa_productores, usuarios where id_usuario_fk = id_usuario AND id_usuario_que_registro = ".$_SESSION['id_usuario']." AND (nombre_productor like '%$buscar%' OR apellido_productor like '%$buscar%')");
			if($result_productores){
			if(mysql_num_rows($result_productores) > 0){
?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover">
	    	<thead>
		        <tr>
		          <th class="centro">#</th>
		          <th class="centro">Usuario</th>
		          <th class="centro">RFC</th>
		          <th>Nombre  del productor</th>
		          <th class="centro">Teléfono</th>
		          <!--<th class="centro">Dirección del productor</th>-->
		          <th class="centro">Estado</th>
		          <th class="centro">Operación</th>
		        </tr>
      		</thead>
      		<tbody>
			<?php
				$i=1;
				 while($row = mysql_fetch_array($result_productores)) {
				 	
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        		<td class="centro"><?php echo $row['nombre_usuario']; ?></td>
		        		<td class="centro"><?php echo $row['rfc_productor']; ?></td>
			          	<td><?php echo $row['nombre_productor']." ".$row['apellido_productor']; ?></td>
			          	<td class="centro"><?php echo $row['telefono_productor']; ?></td>
			          	<!--<td class="centro"><?php echo $row['direccion_productor']; ?></td>-->

			          	<?php 
			          		if($row['estado'] == 1){ 
			          	?>
			          			<td class="centro"> <p class="active"> Activo </p> </td>
			          			<td >
									<div style="margin:0px auto; width:90px;">
				          				<a style="float:left; cursor:pointer;"> 
				          					<span data-toggle="modal" data-target="<?php echo '#myModal'.$i; ?>" data-toggle="tooltip" data-placement="top" title="Editar" class="editar glyphicon glyphicon-edit" aria-hidden="true"></span>
				          				</a>
				          				<div style="width:20px; height:10px; float:left;"></div> 
				          				<a style="float:left;" href="busquedas/desactivarUser.php?id=<?php echo $row['id_productor']; ?>"> 
				          					<span data-toggle="tooltip" data-placement="top" title="Desactivar usuario" class="desactivar glyphicon glyphicon-remove" aria-hidden="true"></span>
				          				</a>
				          				<div style="width:20px; height:10px; float:left;"></div> 
				          				<a style="float:left; cursor:pointer;"> 
				          					<span onclick="showModalInfo(<?php echo $row['id_productor']; ?>)" data-toggle="tooltip" data-placement="top" title="Ver Info." class="desactivar glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				          				</a>
				          			</div>
			          			</td>
			          <?php 
								}else{
								?>
									<td class="centro"> <p class="desactive"> Inactivo </p> </td>
									<td > 
										<div style="margin:0px auto; width:90px;">
											<a style="float:left; cursor: pointer;"> 
					          					<span data-toggle="modal" data-target="<?php echo '#myModal'.$i; ?>" data-toggle="tooltip" data-placement="top" title="Editar" class="editar glyphicon glyphicon-edit" aria-hidden="true"></span>
					          				</a>
					          				<div style="width:20px; height:10px; float:left;"></div>  
					          				<a style="float:left;" href="busquedas/activarUser.php?id=<?php echo $row['id_productor']; ?>"> 
					          					<span data-toggle="tooltip" data-placement="top" title="Activar usuario" class="activar glyphicon glyphicon-ok" aria-hidden="true"></span>
					          				</a>
					          				<div style="width:20px; height:10px; float:left;"></div> 
				          					<a style="float:left; cursor:pointer;"> 
				          						<span onclick="showModalInfo(<?php echo $row['id_productor']; ?>)" data-toggle="tooltip" data-placement="top" title="Ver Info." class="desactivar glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				          					</a>

										</div>
			          			</td>
								<?php
								}
			           ?>
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
				<?php }  ?>

		</div>

        <?php 


        }}else{
        		 ?>
		    	 <br><br>
		    	 <br>
		    	 	<div style="width:500px; margin:0px auto;" class="alert alert-info centro" role="alert"> 
		    	 		<strong>No se encontraron PRODUCTORES registrados.</strong>
		    	 	</div>
		    	 	<br><br>
		    	<?php
        }

			$result_productores = mysql_query("select id_productor, nombre_productor, apellido_productor, ".
				"telefono_productor, direccion_productor, ".
				" rfc_productor, nombre_usuario, contrasena_usuario from empresa_productores,usuarios where id_usuario = id_usuario_fk AND id_usuario_que_registro = ".$_SESSION['id_usuario']);
			
        	$i=1;
        	if($result_productores)
			while($row = mysql_fetch_array($result_productores)) {  
		?>

			<!-- Modal -->
			<div class="modal fade" id="<?php echo 'myModal'.$i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h3 class="modal-title">
		       			<img class="img-header" src="img/imagen.png">Editar productor
		       		</h3>
			      </div>
			      <div class="modal-body">
			          <?php include("editarProductor.php"); ?>
			      </div>
			    </div>
			  </div>
			</div>


		<?php  
			$i=$i+1;
			}
		?>


	<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

	<script type="text/javascript">
		$('#paginacion-resultados').simplePagination();
		</script>
