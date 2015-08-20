<link rel="stylesheet" type="text/css" href="css/views.css">
		<div style="background: #FFFFFF;">
			<div class="modal-header">
        		<h3 class="titulo-header">
        			<img class="img-header" src="../img/estadisticas.png"> &nbsp;Estadísticas
        		</h3>
      		</div>
			<div class="contenido-general-2">
				<div style="width: 45%; float: left; text-align: center">
					<h3 style="color: #000000">Historial de Pedidos</h3>
					<div id="graficaOrdenes" style="width: 100%; height: 400px;"></div>
				</div>
				<div style="width: 45%; float: left; text-align: center">
					<h3 style="color: #000000">Historial de Envíos</h3>
					<div id="graficaEnvios" style="width: 100%; height: 400px;"></div>
				</div>
			</div>
			<div style="clear: both"></div>
		</div>

		<script type="text/javascript">
			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChartOrdenes);

			google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChartEnvios);

			  <?php 
      include("../mod/conexion.php");
      $consulta = "SELECT count(estado_orden) as num, estado_orden from ordenes_distribuidor where id_empaque_fk = $_SESSION[id_empaque] GROUP BY estado_orden";
      $result = mysql_query($consulta);

/*      1    PENDIENTE
2    RECHAZADO POR EMPAQUE
3    ENVIADO
4    CONCRETADO
5    CANCELADO POR EMPAQUE
6    APROBADO
7    PRE-ENVIO
8    CANCELADO POR DISTRIBUIDOR
9    RECHAZADO POR DISTRIBUIDOR
10  CANCELADO POR PUNTO DE VENTA
11  RECHAZADO POR PUNTO DE VENTA
*/

      $pend = 0;
      $rech_emp = 0;
      $enviado = 0;
      $concretado = 0;
      $canc_empa = 0;
      $aprobado = 0;
      $preenvio = 0;
      $canc_dist = 0;
      $rech_dist = 0;
      $canc_pv = 0;
      $rech_pv = 0;

      while ($row = mysql_fetch_array($result)) {
      		if($row['estado_orden'] == 1) $pend = $row['num'];
      		if($row['estado_orden'] == 2) $rech_emp = $row['num'];
      		if($row['estado_orden'] == 3) $enviado = $row['num'];
      		if($row['estado_orden'] == 4) $concretado = $row['num'];
      		if($row['estado_orden'] == 5) $canc_empa = $row['num'];
      		if($row['estado_orden'] == 6) $aprobado = $row['num'];
      		if($row['estado_orden'] == 7) $preenvio = $row['num'];
      		if($row['estado_orden'] == 8) $canc_dist = $row['num'];
      		if($row['estado_orden'] == 9) $rech_dist = $row['num'];
      		if($row['estado_orden'] == 10) $canc_pv = $row['num'];
      		if($row['estado_orden'] == 11) $rech_pv = $row['num'];
      }

      ?>
      function drawChartOrdenes() {
        var data = google.visualization.arrayToDataTable([
					['ESTADO',						'TOTAL'],
					['PENDIENTES',					<?php print $pend ?>],
					['APROBADOS',					<?php print $aprobado ?>],
					['PRE-ENVIO',					<?php print $preenvio ?>],
					['ENVIADO',						<?php print $enviado ?>],
					['CANCELADO POR EMPAQUE',		<?php print $canc_empa ?>],
					['CANCELADO POR DISTRIBUIDOR',	<?php print $canc_dist ?>],
					['RECHAZADO POR EMPAQUE',		<?php print $rech_emp ?>],
					['RECHAZADO POR DISTRIBUIDOR',	<?php print $rech_dist ?>],
					['CONCRETADO',					<?php print $concretado ?>]
				]);

        var options = {
          title: 'NÚMERO DE PEDIDOS CLASIFICADO POR ESTADO DEL PEDIDO',
          is3D: true,
          colors: ['#eea236', '#5bc0de', '#3681C2', '#2e6da4', '#C94242', '#C83636', '#ac2925', '#A01515', '#5cb85c']
        };

				var chart = new google.visualization.PieChart(document.getElementById('graficaOrdenes'));
				chart.draw(data, options);
		}


		<?php 
      include("../mod/conexion.php");
      $consulta = "SELECT count(estado_envio) as num, estado_envio from envios_empaque,ordenes_distribuidor where id_orden = id_orden_fk AND id_empaque_fk = $_SESSION[id_empaque] GROUP BY estado_envio";
      $result = mysql_query($consulta);

/*      1    PENDIENTE
2    RECHAZADO POR EMPAQUE
3    ENVIADO
4    CONCRETADO
5    CANCELADO POR EMPAQUE
6    APROBADO
7    PRE-ENVIO
8    CANCELADO POR DISTRIBUIDOR
9    RECHAZADO POR DISTRIBUIDOR
10  CANCELADO POR PUNTO DE VENTA
11  RECHAZADO POR PUNTO DE VENTA
*/

      $pend = 0;
      $rech_emp = 0;
      $enviado = 0;
      $concretado = 0;
      $canc_empa = 0;
      $aprobado = 0;
      $preenvio = 0;
      $canc_dist = 0;
      $rech_dist = 0;
      $canc_pv = 0;
      $rech_pv = 0;

      while ($row = mysql_fetch_array($result)) {
      		if($row['estado_envio'] == 1) $pend = $row['num'];
      		if($row['estado_envio'] == 2) $rech_emp = $row['num'];
      		if($row['estado_envio'] == 3) $enviado = $row['num'];
      		if($row['estado_envio'] == 4) $concretado = $row['num'];
      		if($row['estado_envio'] == 5) $canc_empa = $row['num'];
      		if($row['estado_envio'] == 6) $aprobado = $row['num'];
      		if($row['estado_envio'] == 7) $preenvio = $row['num'];
      		if($row['estado_envio'] == 8) $canc_dist = $row['num'];
      		if($row['estado_envio'] == 9) $rech_dist = $row['num'];
      		if($row['estado_envio'] == 10) $canc_pv = $row['num'];
      		if($row['estado_envio'] == 11) $rech_pv = $row['num'];
      }

      ?>
      function drawChartEnvios() {
        var data = google.visualization.arrayToDataTable([
					['ESTADO',						'TOTAL'],
					['PENDIENTES',					<?php print $pend ?>],
					['APROBADOS',					<?php print $aprobado ?>],
					['PRE-ENVIO',					<?php print $preenvio ?>],
					['ENVIADO',						<?php print $enviado ?>],
					['CANCELADO POR EMPAQUE',		<?php print $canc_empa ?>],
					['CANCELADO POR DISTRIBUIDOR',	<?php print $canc_dist ?>],
					['RECHAZADO POR EMPAQUE',		<?php print $rech_emp ?>],
					['RECHAZADO POR DISTRIBUIDOR',	<?php print $rech_dist ?>],
					['CONCRETADO',					<?php print $concretado ?>]
				]);

        var options = {
          title: 'ENVÍOS CLASIFICADOS POR EL ESTADO DEL ENVÍO',
          colors: ['#eea236', '#5bc0de', '#3681C2', '#2e6da4', '#C94242', '#C83636', '#ac2925', '#A01515', '#5cb85c'],
          is3D: true,

        };

        var chart = new google.visualization.PieChart(document.getElementById('graficaEnvios'));
        chart.draw(data, options);
      }

	    </script>