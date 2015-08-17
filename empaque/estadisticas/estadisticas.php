<link rel="stylesheet" type="text/css" href="css/views.css">
		<div style="background: #FFFFFF;">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../img/estadisticas.png"> &nbsp;Estadísticas
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div style="width: 45%; float: left; text-align: center">
					<h3 style="color: #000000">Historial de Órdenes</h3>
					<div id="graficaOrdenes" style="width: 100%; height: 400px;"></div>
				</div>
				<div style="width: 45%; float: left; text-align: center">
					<h3 style="color: #000000">Historial de Pedidos</h3>
					<div id="graficaPedidos" style="width: 100%; height: 400px;"></div>
				</div>
			</div>
			<div style="clear: both"></div>
		</div>

		<!--<script type="text/javascript" src="../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>-->
		<!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>-->

		<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChartOrdenes);

			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChartPedidos);

			function drawChartOrdenes() {
				var data = google.visualization.arrayToDataTable([
					['ESTADO',						'TOTAL'],
					['PENDIENTES',					2],
					['APROBADOS',					5],
					['PRE-ENVIO',					1],
					['ENVIADO',						3],
					['CANCELADO POR EMPAQUE',		3],
					['CANCELADO POR DISTRIBUIDOR',	2],
					['RECHAZADO POR EMPAQUE',		1],
					['RECHAZADO POR DISTRIBUIDOR',	1],
					['CONCRETADO',					22]
				]);

				var options = {
					backgroundColor: '#FFFFFF',
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
					['PENDIENTES',						1],
					['APROBADOS',						2],
					['PRE-ENVIO',						1],
					['ENVIADO',							2],
					['CANCELADO POR DISTRIBUIDOR',		1],
					['CANCELADO POR PUNTO DE VENTA',	2],
					['RECHAZADO POR DISTRIBUIDOR',		1],
					['RECHAZADO POR PUNTO DE VENTA',	1],
					['CONCRETADO',						10]
				]);

				var options = {
					backgroundColor: '#FFFFFF',
					is3D: true,
					colors: ['#eea236', '#5bc0de', '#3681C2', '#2e6da4', '#C94242', '#C83636', '#ac2925', '#A01515', '#5cb85c'],
					// colors: ['#eea236', '#5bc0de', '#5388B7', '#2e6da4', '#f0ad4e', '#EE9D2B', '#c9302c', '#ac2925', '#5cb85c'],
				};

				var chart = new google.visualization.PieChart(document.getElementById('graficaPedidos'));
				chart.draw(data, options);
			}
	    </script>