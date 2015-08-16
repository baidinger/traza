<?php
			include("../../mod/conexion.php");
			$buscar = $_POST['buscar'];
			$filtro = $_POST['filtro'];

			$result_productores = mysql_query("select id_productor, nombre_productor, apellido_productor, ".
				"telefono_productor, direccion_productor, ".
				" rfc_productor, id_usuario_fk, estado_p, nombre_usuario from empresa_productores, usuarios where id_usuario_fk = id_usuario AND id_usuario_que_registro = ".$_SESSION['id_receptor']." AND (nombre_productor like '%$buscar%' OR apellido_productor like '%$buscar%' OR rfc_productor like '%$buscar%' OR id_productor = '$buscar') $filtro ORDER BY nombre_productor ASC, apellido_productor ASC");
			if($result_productores){
				$count  = mysql_num_rows($result_productores);
	if( $count > 0 ){
		
?>

<div id="paginacion-resultados" style="width:95%; margin:0px auto;">
	    <table class="table table-hover" style="font-size: 14px">
	    	<thead>
		        <tr>
		          <th class="centro">#</th>
		          <th >Usuario</th>
		          <th class="centro">ID</th>
		          <th>Nombre  del productor</th>
		          <th class="centro">RFC</th>
		          <th class="centro">Teléfono</th>
		          <th class="centro">Estado</th>
		          <th style="text-align: right"></th>
		        </tr>
      		</thead>
      		<tbody>
			<?php
					
	print "<p>Se encontraron " .  $count . " resultados.</p>";
	$i=1;
				 while($row = mysql_fetch_array($result_productores)) {
				 	
				 	?>
				 	<tr>
		        		<td class="centro"><?php echo $i; ?></td>
		        		<td><?php echo $row['nombre_usuario']; ?></td>
		        		<td class="centro"><a href="index.php?productor=<?php print $row['id_productor'] ?>"> <?php echo str_pad($row['id_productor'], 7,"0",STR_PAD_LEFT); ?> </a></td>
			          	<td> <a href="index.php?productor=<?php print $row['id_productor'] ?>">  <?php echo $row['nombre_productor']." ".$row['apellido_productor']; ?> </a></td>
			          	<td class="centro"><?php echo $row['rfc_productor']; ?></td>
			          	<td class="centro"><?php echo $row['telefono_productor']; ?></td>
			          	<!--<td class="centro"><?php echo $row['direccion_productor']; ?></td>-->

			          	<?php if($row['estado_p'] == 1){ ?>
			          			<td class="centro"> <p class="label label-success"> Activo </p> </td>
			          	<?php }else{ ?>
			          			<td class="centro"> <p class="label label-danger"> Inactivo </p> </td>
			          	<?php } ?>
			          			<td >
									<div style="margin:0px; width:90px; float: right">
										<a href="index.php?productor=<?php echo $row['id_productor'];?>" style="float:right; cursor:pointer;"> 
				          					<span data-toggle="tooltip" data-placement="top" title="Ver Info." class="desactivar glyphicon glyphicon-eye-open" aria-hidden="true"></span>
				          				</a>
				          				
				          				<div style="width:10px; height:10px; float:right;"></div> 

				          				<!-- ACCION HABILITAR -->
				          				<?php if($row['estado_p'] == 1){ ?>
				          				<a style="float:right;" href="busquedas/habilitar.php?id=<?php echo $row['id_productor']; ?>&status=0&rol=1"> 
				          					<span data-toggle="tooltip" data-placement="top" title="Desactivar" class="desactivar glyphicon glyphicon-remove" aria-hidden="true"></span>
				          				</a>
				          				<?php } else { ?>
				          				<a style="float:right;" href="busquedas/habilitar.php?id=<?php echo $row['id_productor']; ?>&status=1&rol=1"> 
					          					<span data-toggle="tooltip" data-placement="top" title="Activar" class="activar glyphicon glyphicon-ok" aria-hidden="true"></span>
					          			</a>
				          				<?php } ?>
				          				<!--   - - - - - - - - - - - -  - - - - -  -->

				          				<div style="width:10px; height:10px; float:right;"></div> 
				          				<a style="float:right; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Editar"> 
				          					<span onclick="editar(<?php print $row['id_productor'] ?>)" class="editar glyphicon glyphicon-edit" aria-hidden="true"></span>
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
				<?php }  ?>

		</div>

        <?php 


        }else
        {
        	
        		 ?>
		    	 <br><br>
		    	 <br>
		    	 	<div style="width:500px; margin:0px auto;" class="alert alert-info centro" role="alert"> 
		    	 		<strong>No se encontraron PRODUCTORES registrados.</strong>
		    	 	</div>
		    	 	<br><br>
		    	<?php	
        }
    }else{
        		 ?>
		    	 <br><br>
		    	 <br>
		    	 	<div style="width:500px; margin:0px auto;" class="alert alert-info centro" role="alert"> 
		    	 		<strong>No se encontraron PRODUCTORES registrados.</strong>
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
		       			<img class="img-header" src="img/productor.png">Editar productor
		       		</h3>
			      </div>
			      <div id="data-child" class="modal-body">
	
			      </div>
			    </div>
			  </div>
			</div>


	<script type="text/javascript">
		$('#paginacion-resultados').simplePagination();
		$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			});
	</script>
