<?php session_start();
	$buscar = $_POST['buscar'];

?>
<div id="paginacion-resultados"  style="width:95%; margin: 0 auto">
		    <table class="table table-hover" style="font-size: 14px">
		    	<thead>
			        <tr>
			          <th>#</th>
			          <th>Usuario</th>
			          <th>Nombre </th>
			          <th>Teléfono</th>
			          <th>Nivel autorizado</th>
			          <th>Privilegios</th>
			          <th>Estado</th>
			          <th></th>
			        </tr>
	      		</thead>
	      		<tbody>
				<?php
				include('../../mod/conexion.php');
				$buscar = $_POST['buscar'];
				 $consulta = "SELECT id_receptor, id_usuario, nombre_receptor, apellido_receptor, telefono_receptor, direccion_receptor, nombre_usuario, estado_usuario, nivel_autorizacion_usuario, pedidos, lotes, envios from usuario_empaque, usuarios where usuario_empaque.id_usuario_fk = usuarios.id_usuario AND usuario_empaque.id_empaque_fk = $_SESSION[id_empaque] AND (nombre_receptor like '%$buscar%' OR apellido_receptor like '%$buscar%' OR nombre_usuario LIKE '%$buscar%') order by nombre_receptor ASC, apellido_receptor ASC" ;
				 $result_receptores = mysql_query($consulta);
				$i=1;
				if($result_receptores){
					
					 while($row = mysql_fetch_array($result_receptores)) {
					 	
					 	?>
					 	<tr>
			        		<td><?php echo $i; ?></td>
			        		<td><?php echo $row['nombre_usuario']; ?></td>
				          	<td><a href="index.php?usuarioemp=<?php print $row['id_receptor'] ?>"><?php echo $row['nombre_receptor'] ." ". $row['apellido_receptor']; ?></a></td>
				          	<td><?php echo $row['telefono_receptor']; ?></td>
				          	<td><span class="label label-info"><?php echo ($row['nivel_autorizacion_usuario'] == 1) ? "ADMINISTRADOR" : "NORMAL" ?></span></td>
				          	<td><?php echo ($row['pedidos'] == '1')  ? "pedidos" : ""; echo ($row['lotes'] == '1')  ? ",lotes" : ""; echo ($row['envios'] == '1')  ? ",envios" : "";  ?></td>
				          	
				          			<td> 
							<?php if($row['estado_usuario'] == 1){ 	?>
				          				<span class="label label-success"> Activo </span> 
				          	 <?php 	}else{ 	?>
									<span class="label label-danger"> Inactivo </span>
							<?php } ?>
									</td>
				       	   			<td class="centro">
				       	   				<a style="float: right" href="index.php?usuarioemp=<?php print $row['id_receptor'] ?>" data-toggle="tooltip" data-placement="top" title="Ver info.">
				          				<span class="glyphicon glyphicon-eye-open"></span></a>				          				
				          				<div style="width:10px; height:10px; float:right;"></div> 
				          				<?php if($row['nivel_autorizacion_usuario'] == 2) { ?>
				          				<?php if($row['estado_usuario'] == 1){ 	?>
				          				<a style="float: right" href="usuarios/habilitar_usuario.php?id=<?php echo $row['id_usuario']; ?>&status=0" data-toggle="tooltip" data-placement="top" title="Desactivar usuario"> 
				          					<span class="glyphicon glyphicon-remove"></span>
				          				</a>
				          				
				          				<?php 	}else{ 	?>
				          				<a style="float: right" href="usuarios/habilitar_usuario.php?id=<?php echo $row['id_usuario']; ?>&status=1" data-toggle="tooltip" data-placement="top" title="Activar usuario"> 
				          					<span class="glyphicon glyphicon-ok" ></span>
				          				</a>
				          				
				          				<?php } ?>
				          				<?php }else{ ?>
				          					<div style="width:14px; height:14px; float:right;"></div> 		
				          				<?php } ?>
				          				<div style="width:10px; height:10px; float:right;"></div> 
				          				<a style="float: right" href="#" onclick="editar(<?php print $row['id_receptor'] ?>,<?php print $_SESSION['id_empaque']?>,<?php print $row['id_usuario'] ?>)" data-toggle="tooltip" data-placement="top" title="Editar" > 
				          					<span data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-edit"></span>
				          				</a>
				          			</td>
				         
							
			        	</tr>
			        <?php  
			        $i=$i+1;
					 }
				}
				  ?>
	          	</tbody>
	        </table>


	        <?php if($i > 1){ ?>
				<div class="my-navigation" style="margin: 0px auto;">
					<div class="simple-pagination-page-numbers"></div>
					<br><br><br>
				</div>
			<?php } else{ ?>
				<div class="alert alert-info" role="alert" style="text-align: center;">
					<strong>Sin resultados...</strong> No hay usuarios registrados.
				</div>
			<?php } ?>

		</div>


		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h3 class="modal-title">
	       			<img class="img-header" src="img/imagen.png">Editar usuario
	       		</h3>
		      </div>
		      <div id="data-child" class="modal-body">
		      </div>
		    </div>
		  </div>
		</div>

	
			<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

			<script type="text/javascript">
				$('#paginacion-resultados').simplePagination();
				$(function () {
			  		$('[data-toggle="tooltip"]').tooltip()
				});
			</script>