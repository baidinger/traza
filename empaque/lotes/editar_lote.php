<!DOCTYPE html>
<html>
	<head lang="ES">
		<title>Registro - lote</title>
		<meta charset="UTF-8">
		<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
		<!--<link rel="stylesheet" type="text/css" href="css/estilos.css">-->
	</head>
	<body>

		<?php
			include('../../mod/conexion.php');
			$id_lote = $_POST['id'];
			$consulta = "SELECT id_lote, rendimiento_cajas, rendimiento_kg, telefono_productor, rfc_productor, cant_cajas_lote, cant_kilos_lote, remitente_lote, fecha_recibo_lote, hora_recibo_lote, costo_lote, id_empaque_fk, nombre_productor, apellido_productor, nombre_producto, variedad_producto FROM lotes, empresa_productores, productos, productos_productores WHERE productos_productores.id_productos_productores = lotes.id_productos_productores_fk AND productos_productores.id_producto_fk = productos.id_producto AND productos_productores.id_productor_fk = empresa_productores.id_productor AND id_lote = $id_lote";
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
		?>
	<div class="alert alert-warning">¡ATENCIÓN! La modificación de estos datos puede alterar significativamente las estadisticas del sistema.</div>
	<div class="contenedor-form">
		<form class="form-horizontal" role="form" method="post" action="lotes/editar_lote_admin.php">
			<table class="table" style="font-size:14px">
				 <tr>
				<td width="200">
			    	<label >Nombre del productor: </label></td>
				<td>
			    		<input type="text" class="form-control input" 
			    		name="nombre_producto" disabled value="<?php print $row['rfc_productor']." - ".$row['nombre_productor']." ".$row['apellido_productor'] ?>">
			    		<input type="hidden" value="<?php print $id_lote ?>" name="id_lote">
		    	</td>
				</tr>
				<tr>
					<td><label >Tipo de producto </label></td>
			    	
			    	<td>
			    		<?php 
							$idProductor = $_POST['id_productor'];


						    $consulta = "SELECT prds.id_producto, id_productos_productores, ubicacion_huerta, prds.nombre_producto, prds.variedad_producto FROM productos AS prds, productos_productores AS prdsepqs WHERE prds.id_producto = prdsepqs.id_producto_fk AND prdsepqs.id_productor_fk = $idProductor";
							$resultado = mysql_query($consulta);

							if(mysql_num_rows($resultado ) > 0){
							?>
							<select <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> class="form-control" name="id_productos_productores" id="selectProducto">
								<?php 

									while($row1 = mysql_fetch_array($resultado)){ ?>
										<option value="<?php echo $row1['id_productos_productores']; ?>"><?php echo $row1['nombre_producto']." ".$row1['variedad_producto']." - ".$row1['ubicacion_huerta']; ?></option>
									<?php }
								?>
							</select>
						<?php } else {?>
							<div class="alert alert-danger" role="alert"><p>No hay productos asignados a este productor</p></div>
						<?php } ?>
		         </td>
		         <tr>
				<td>
			    	<label >Cajas recib. / rend. cajas: </label></td>
				<td>
			    		<input style="width: 150px; float: left" <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> type="number" class="form-control input" 
			    		name="cantidad_cajas" 
			    		placeholder="Cantidad de cajas" required min ="0" value="<?php print $row['cant_cajas_lote'] ?>"> <label style="float: left; margin-left: 20px">/</label> 
			    		<input style="width: 150px; float: left; margin-left: 20px" <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> type="number" class="form-control input" 
			    		name="rend_cajas"
			    		placeholder="Rend. cajas" required min ="0" value="<?php print $row['rendimiento_cajas'] ?>">
			    	</td>
				</tr>

				<tr>
					<td>
			    	<label >Kilos recib. / redn. kilos: </label>
			    	</td><td>
			    		<input style="width: 150px; float: left" <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> type="number" class="form-control input" 
			    		name="cantidad_kilos" 
			    		placeholder="Núm. de kilos" min="0" required value="<?php print $row['cant_kilos_lote'] ?>"><label style="float: left; margin-left: 20px">/</label> 
			    		<input style="width: 150px; float: left; margin-left: 20px" <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> type="number" class="form-control input" 
			    		name="rendimiento_kg" 
			    		placeholder="Rend. kilos" min="0" required value="<?php print $row['rendimiento_kg'] ?>">
			    	</td>
		        </tr>
				  <tr><td>
			    	<label >Nombre del remitente: </label>
			    </td>
			    	<td>
			    		<input <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> type="text" class="form-control input" 
			    		name="nombre_remitente" id="" 
			    		placeholder="Nombre del remitente" required value="<?php print $row['remitente_lote'] ?>">
		        </td>
		    </tr>
		        <tr>
					<td>
			    	<label >Costo del lote: </label>
			    	</td>
			    	<td>
			    		<input <?php if($_SESSION['nivel_socio'] == 2) print "disabled" ?> type="number" min="0" class="form-control input" 
			    		name="costo_lote" id="" 
			    		placeholder="Costo del lote" required value="<?php print $row['costo_lote'] ?>">
		        	</td>
		</table>
			  	<hr>
			  	<center>
		     			<button type="submit" id="guardar" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Actualizar</button>
		     			<input type="hidden" name="url" value="../index.php?op=admon_lotes">
		     		</center>
		     	</div>
	    </div>
	     </form>	
	 </div>

	 
	</body>




</html>