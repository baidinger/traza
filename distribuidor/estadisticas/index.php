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

		<script type="text/javascript" src="../mod/paises.js"></script>
	</head>

	<body>
		<?php 
			include('../mod/navbar.php');
		?>
		<div class="contenido-general">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../../img/estadisticas.png"> &nbsp;Estadísticas
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div id="cargando-graficas" style="display: block">
					<center>
						<h2>¡Generando Gráficas!</h2>
						<h3>Por favor espere...</h3>
						<img src="../../img/cargando.gif">
					</center>
				</div>

				<div id="graficas-cargadas" style="display: none">
					<div style="width: 50%; float: left;">
						<h3>Historial de Órdenes</h3>
						<div id="graficaOrdenes" style="width: 100%; height: 400px;"></div>

						<?php 
							include('../../mod/conexion.php');

							$consulta = "SELECT id_distribuidor_fk, id_usuario_distribuidor FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
							$resultado = mysql_query($consulta);
							$row = mysql_fetch_array($resultado);
							// $id_distribuidor_fk = $row['id_usuario_distribuidor'];
							$id_distribuidor_fk = $row['id_distribuidor_fk'];

							$datosGraficaOrdenes = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0);

							$consulta = "SELECT ords.estado_orden, COUNT(ords.id_orden) AS total_ordenes FROM ordenes_distribuidor AS ords, empresa_empaques AS epqs, usuario_distribuidor AS usudist, empresa_distribuidores AS empdist WHERE ords.id_empaque_fk = epqs.id_empaque AND ords.id_usuario_distribuidor_fk = usudist.id_usuario_distribuidor AND usudist.id_distribuidor_fk = empdist.id_distribuidor AND empdist.id_distribuidor = $id_distribuidor_fk GROUP BY ords.estado_orden";
							$resultado = mysql_query($consulta);
							while($row = mysql_fetch_array($resultado)){
								$datosGraficaOrdenes[$row['estado_orden']] = $row['total_ordenes'];
							}
						?>

					</div>
					<div style="width: 50%; float: right;">
						<h3>Historial de Pedidos</h3>
						<div id="graficaPedidos" style="width: 100%; height: 400px;"></div>

						<?php 
							$datosGraficaPedidos = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0);

							$consulta = "SELECT ordspv.estado_orden, COUNT(id_orden) AS total_ordenes FROM ordenes_punto_venta AS ordspv, usuario_punto_venta AS ususpv, empresa_punto_venta AS mpsapv WHERE ordspv.id_usuario_punto_venta_fk = ususpv.id_usuario_pv AND ususpv.id_punto_venta_fk = mpsapv.id_punto_venta AND ordspv.id_distribuidor_fk = $id_distribuidor_fk GROUP BY ordspv.estado_orden";
							$resultado = mysql_query($consulta);
							while($row = mysql_fetch_array($resultado)){
								$datosGraficaPedidos[$row['estado_orden']] = $row['total_ordenes'];
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="../../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>

		<script type="text/javascript">
			$(window).load(function() {
				$('#cargando-graficas').css('display', 'none');
				$('#graficas-cargadas').css('display', 'block');
			});

			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChartOrdenes);

			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChartPedidos);

			function drawChartOrdenes() {
				var data = google.visualization.arrayToDataTable([
					['ESTADO',						'TOTAL'],
					['PENDIENTES',					<?php echo $datosGraficaOrdenes[1]; ?>],
					['APROBADOS',					<?php echo $datosGraficaOrdenes[6]; ?>],
					['PRE-ENVIO',					<?php echo $datosGraficaOrdenes[7]; ?>],
					['ENVIADO',						<?php echo $datosGraficaOrdenes[3]; ?>],
					['CANCELADO POR EMPAQUE',		<?php echo $datosGraficaOrdenes[5]; ?>],
					['CANCELADO POR DISTRIBUIDOR',	<?php echo $datosGraficaOrdenes[8]; ?>],
					['RECHAZADO POR EMPAQUE',		<?php echo $datosGraficaOrdenes[2]; ?>],
					['RECHAZADO POR DISTRIBUIDOR',	<?php echo $datosGraficaOrdenes[9]; ?>],
					['CONCRETADO',					<?php echo $datosGraficaOrdenes[4]; ?>]
				]);

				var options = {
					backgroundColor: '#F8F8F8',
					is3D: true,
					colors: ['#eea236', '#5bc0de', '#3681C2', '#2e6da4', '#C94242', '#C83636', '#ac2925', '#A01515', '#5cb85c'],
					// colors: ['#eea236', '#5bc0de', '#5388B7', '#2e6da4', '#f0ad4e', '#EE9D2B', '#c9302c', '#ac2925', '#5cb85c'],
				};

				var chart = new google.visualization.PieChart(document.getElementById('graficaOrdenes'));
				chart.draw(data, options);
			}

			function drawChartPedidos() {
				var data = google.visualization.arrayToDataTable([
					['ESTADO',							'TOTAL'],
					['PENDIENTES',						<?php echo $datosGraficaPedidos[1]; ?>],
					['APROBADOS',						<?php echo $datosGraficaPedidos[6]; ?>],
					['PRE-ENVIO',						<?php echo $datosGraficaPedidos[7]; ?>],
					['ENVIADO',							<?php echo $datosGraficaPedidos[3]; ?>],
					['CANCELADO POR DISTRIBUIDOR',		<?php echo $datosGraficaPedidos[8]; ?>],
					['CANCELADO POR PUNTO DE VENTA',	<?php echo $datosGraficaPedidos[10]; ?>],
					['RECHAZADO POR DISTRIBUIDOR',		<?php echo $datosGraficaPedidos[9]; ?>],
					['RECHAZADO POR PUNTO DE VENTA',	<?php echo $datosGraficaPedidos[11]; ?>],
					['CONCRETADO',						<?php echo $datosGraficaPedidos[4]; ?>]
				]);

				var options = {
					backgroundColor: '#F8F8F8',
					is3D: true,
					colors: ['#eea236', '#5bc0de', '#3681C2', '#2e6da4', '#C94242', '#C83636', '#ac2925', '#A01515', '#5cb85c'],
					// colors: ['#eea236', '#5bc0de', '#5388B7', '#2e6da4', '#f0ad4e', '#EE9D2B', '#c9302c', '#ac2925', '#5cb85c'],
				};

				var chart = new google.visualization.PieChart(document.getElementById('graficaPedidos'));
				chart.draw(data, options);
			}
	    </script>
	</body>
</html>