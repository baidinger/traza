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
	include("../../mod/conexion.php");
	$id_orden = $_POST['id'];

	$c = "SELECT * FROM envios_empaque where envios_empaque.id_orden_fk = $id_orden";
	$r = mysql_query($c);
	if($r){
		if(mysql_num_rows($r) > 0)
		{
			?>
			<div class="alert alert-danger">Ya se ha registrado un envio para ésta orden</div>
			<?php
			return;
		}
	}

	//$consulta = "SELECT * FROM ordenes_distribuidor, envios_empaque, usuario_empaque where id_orden = $id_orden AND ordenes_distribuidor.id_orden = envios_empaque.id_orden_fk AND usuario_empaque.id_empaque_fk = ordenes_distribuidor.id_empaque_fk AND usuario_empaque.id_usuario_fk = ".$_SESSION['id_usuario'];
	$consulta = "SELECT * FROM ordenes_distribuidor as od where od.id_orden = $id_orden";
	$result = mysql_query($consulta);
	if($result)
	{
		if(mysql_num_rows($result) > 0)
		{ 

			$row = mysql_fetch_array($result);

			if($row['estatus_orden'] == 4) { ?>
			<div class="alert alert-success">La orden seleccionada ha sido CONCRETADA</div>
			<?php }
			else if($row['estatus_orden'] == 5) { ?>
			<div class="alert alert-danger">La orden seleccionada ha sido CANCELADA</div>
			<?php } 
			else if($row['estatus_orden'] == 1) { ?>
			<div class="alert alert-danger">La orden seleccionada no ha sido APROBADA</div>
			<?php } else if($row['estatus_orden'] == 6) { ?>

<?php
 $consulta = "SELECT * FROM ordenes_distribuidor as od, empresa_distribuidores as ed, usuario_distribuidor as ud where od.id_orden = $id_orden AND od.id_usuario_distribuidor_fk = ud.id_usuario_distribuidor AND ud.id_distribuidor_fk = ed.id_distribuidor";
	$result = mysql_query($consulta);
	if($result)
	{
		if(mysql_num_rows($result) > 0)
		{ 

			$row = mysql_fetch_array($result);
?>
	<div class="contenedor-form">
		<form class="form-horizontal" role="form" method="post" action="envios/enviar_producto.php">

			  	<p>&nbsp;</p>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Número de órden: </label>
			    	<div class="col-sm-10">
			    		<span class="alert alert-info"><?php print $id_orden ?></span>
			    		<input type="hidden" name="id_orden" value="<?php print $id_orden ?>">
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Distribuidor </label>
			    	<div class="col-sm-10">
			    		<?php print $row['nombre_distribuidor'] ?>
			    		<input type="hidden" name="id_distribuidor" value="<?php print $row['id_distribuidor']?>">
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Productos solicitados: </label>
			    	<div class="col-sm-10">
			    		<?php 
			    		$c = "SELECT * FROM productos, ordenes_distribuidor_detalles WHERE id_producto = id_producto_fk AND id_orden_fk = ".$id_orden;
						$res = mysql_query($c);
						if(mysql_num_rows($res) > 0){
							while($row1 = mysql_fetch_array($res)) {
			        			echo $row1['nombre_producto']. " ".$row1['variedad_producto']."<br>"; 
			        		}
			        	}

			    		?>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Costo: </label>
			    	<div class="col-sm-10">
			    		<?php print "$ ".$row['costo_orden'] ?>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Estado </label>
			    	<div class="col-sm-10">
			    		<span class="label label-danger"><?php print ($row['estatus_orden'] == 6) ? "APROBADA" : "--" ?></span>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-2 control-label">Descripción </label>
			    	<div class="col-sm-10">
			    		<textarea name="descripcion" class="form-control" placeholder="Escribe una descripción"></textarea>
		         	</div>
				  </div>
			  	<hr>
			  	<center>
	     			<button type="submit" id="enviar_orden" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Enviar producto</button>
	     			<input type="hidden" name="url" value="../index.php?op=envios">
	     		</center>


	     </form>	
	 </div>	 
	<?php } } } }
		else
		{ ?>
	<div class="alert alert-danger">NO SE ENCONTRÓ UNA ORDEN CON ESE NÚMERO</div>
<?php 	}
	}else
	{
?>
<div class="alert alert-warning">Ingresa un número de orden válido</div>
<?php } ?>
	
	</body>

	<script type="text/javascript" src="../lib/jquery/jquery-1.11.1.min.js"></script>
	<!--<script type="text/javascript" src="script/bootstrap.min.js"></script>-->

</html>