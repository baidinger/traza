<?php 
	$buscar = $_POST['buscar'];

?>
<div id="paginacion-resultados"  style="width:95%; margin: 0 auto">
		    <table class="table table-hover">
		    	<thead>
			        <tr>
			          <th>#</th>
			          <th>Usuario</th>
			          <th>Nombre </th>
			          <th>Teléfono</th>
			          <!--<th>Dirección</th>-->
			          <th>Nivel autorizado</th>
			          <th>Privilegios</th>
			          <th>Estado</th>
			          <th>Acción</th>
			        </tr>
	      		</thead>
	      		<tbody>
				<?php
				include('../../mod/conexion.php');
				$buscar = $_POST['buscar'];
				$consulta = "select id_usuario_fk, id_empaque_fk, id_empaque, nombre_empaque from usuario_empaque, empresa_empaques where usuario_empaque.id_usuario_fk = ".$_SESSION['id_usuario']." AND usuario_empaque.id_empaque_fk = empresa_empaques.id_empaque";
				$empaque = mysql_query($consulta);
				 if($row = mysql_fetch_array($empaque)) {
				 	 $nombre_empaque = $row['nombre_empaque'];
				 	 $id_empaque = $row['id_empaque'];
				 }
				$result_receptores = mysql_query("select id_receptor, id_usuario, nombre_receptor, apellido_receptor, telefono_receptor, direccion_receptor, nombre_usuario, estado_usuario, nivel_autorizacion_usuario, pedidos, lotes, envios from usuario_empaque, usuarios where usuario_empaque.id_usuario_fk = usuarios.id_usuario AND usuario_empaque.id_empaque_fk = ".$id_empaque." AND (nombre_receptor like '%$buscar%' OR apellido_receptor like '%$buscar%') order by nombre_receptor ASC, apellido_receptor ASC" );
				$i=1;
				if($result_receptores){
					
					 while($row = mysql_fetch_array($result_receptores)) {
					 	
					 	?>
					 	<tr>
			        		<td><?php echo $i; ?></td>
			        		<td><?php echo $row['nombre_usuario']; ?></td>
				          	<td><?php echo $row['nombre_receptor'] ." ". $row['apellido_receptor']; ?></td>
				          	<td><?php echo $row['telefono_receptor']; ?></td>
				          	<!--<td><?php echo $row['direccion_receptor']; ?></td>-->
				          	<td><span class="label label-info"><?php echo ($row['nivel_autorizacion_usuario'] == 1) ? "ADMINISTRADOR" : "NORMAL" ?></span></td>
				          	<td><?php echo ($row['pedidos'] == '1')  ? "pedidos" : ""; echo ($row['lotes'] == '1')  ? ",lotes" : ""; echo ($row['envios'] == '1')  ? ",envios" : "";  ?></td>
				          	<?php 
				          		if($row['estado_usuario'] == 1){ 
				          	?>
				          			<td> <span class="label label-success"> Activo </span> </td>
				          			<td class="centro">

				          				<a href="#" onclick="editar(<?php print $row['id_receptor'] ?>,<?php print $id_empaque?>,<?php print $row['id_usuario'] ?>)" > 
				          					<span data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-edit"></span>
				          				</a>&nbsp;&nbsp;
				          				<?php if($row['nivel_autorizacion_usuario'] == 2) { ?>
				          				<a href="usuarios/habilitar_usuario.php?id=<?php echo $row['id_usuario']; ?>&status=0"> 
				          					<span data-toggle="tooltip" data-placement="top" title="Desactivar usuario" class="glyphicon glyphicon-remove"></span>
				          				</a>&nbsp;&nbsp;
				          			<?php } ?>
				          			<a onclick="ver(<?php echo $row['id_receptor'] ?>)" data-toggle="modal" data-target="#myModal1"  href="#">
				          				<span class="glyphicon glyphicon-eye-open"></span></a>
				          			</td>
				          <?php 
									}else{
									?>
										<td > <span clas="label label-danger"> Inactivo </span> </td>
										<td class="centro"> 

				          				<a href="#" onclick="editar(<?php print $row['id_receptor'] ?>,<?php print $id_empaque ?>,<?php print $row['id_usuario'] ?>)"> 
				          					<span data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Editar" class="glyphicon glyphicon-edit" ></span>
				          				</a> &nbsp;&nbsp;
				          				<a href="usuarios/habilitar_usuario.php?id=<?php echo $row['id_usuario']; ?>&status=1"> 
				          					<span data-toggle="tooltip" data-placement="top" title="Activar usuario" class="glyphicon glyphicon-ok" ></span>
				          				</a>&nbsp;&nbsp;

				          				<a onclick="ver(<?php echo $row['id_receptor'] ?>)" data-toggle="modal" data-target="#myModal1"  href="#">
				          				<span class="glyphicon glyphicon-eye-open"></span></a>
				          			</td>
									<?php
									}
				           ?>
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
		          <?php //include("editar_usuario_empaque.php"); ?>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h3 class="modal-title">
	       			<img class="img-header" src="img/imagen.png">Datos de usuario
	       		</h3>
		      </div>
		      <div id="data-child1" class="modal-body">
		          <?php //include("editar_usuario_empaque.php"); ?>
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