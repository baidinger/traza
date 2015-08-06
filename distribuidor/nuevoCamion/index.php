<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: ../../productor/');
					break;
			case 2: header('Location: ../../empaque/');
					break;
			case 4: header('Location: ../../puntoVenta/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=0.5">
		<link rel="shortcut icon" href="../../img/logo_trazabilidad.png" type='image/png'>

		<link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="../../lib/bootstrap-3.3.5/css/bootstrap-responsive.min.css" rel="stylesheet"> -->
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>

	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../../img/nuevo_envio.png"> Registrar Camión
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div class="div-contenedor-form">
					<form class="form-horizontal" role="form" method="post" action="../mod/registrar_camion.php">
			      		<div>
			      			<?php 
			      				include('../../mod/conexion.php');

			      				$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
			      				$resultado = mysql_query($consulta);
			      				$row = mysql_fetch_array($resultado);
			      				$idDistribuidorFK = $row['id_distribuidor_fk'];
			      			?>
					      	<div class="modal-body">
					      		<div class="form-group">
							    	<label class="col-sm-2 control-label">Chofer: </label>
							    	<div class="col-sm-10">
							    		<input type="text" class="form-control input" name="inputChofer" id="inputChofer" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Nombre del chofer..." autofocus required>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Marca: </label>
							    	<div class="col-sm-10">
							    		<div class="form-inline">
						    				<input type="text" class="form-control input" name="inputMarca" id="inputMarca" pattern="[A-Za-zÑñáéíóúÁÉÍÓÚ]+([ ][A-Za-zÑñáéíóúÁÉÍÓÚ]+)*" title="Ingresa sólo letras y sin espacios extras" placeholder="Marca del camión..." required>

						    				<label style="margin-left: 30px;">Modelo: </label>
							    			<input type="text" class="form-control input" name="inputModelo" id="inputModelo" style="float:right;" pattern="[0-9]{4}" title="Ingresa 4 dígitos numéricos" placeholder="Modelo del camión..." required>
							    		</div>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Placas: </label>
							    	<div class="col-sm-10">
							    		<div class="form-inline">
							    			<input type="text" class="form-control input" name="inputPlacas" id="inputPlacas" pattern="([-A-Za-z0-9])+" title="Ingresa letras, números y guiones" placeholder="Placas del camion..." required>
							    		</div>
							    	</div>
							  	</div>
							  	<div class="form-group">
							    	<label class="col-sm-2 control-label">Descripción: </label>
							    	<div class="col-sm-10">
							    		<textarea class="form-control input" rows="4" name="inputDescripcion" id="inputDescripcion" placeholder="Descripción del camión..."></textarea>
							    	</div>
							  	</div>
							  	<input type="hidden" name="inputDistribuidor" value="<?php echo $idDistribuidorFK; ?>">
							  	<hr>
							  	<center>
					      			<button id="enviar" type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Registrar</button>
					      		</center>
					      	</div>
					    </div>
			      	</form>
					<?php
						mysql_close();
					?>
				</div>
			</div>
		</div>
	</body>
</html>