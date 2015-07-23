
<?php
	$idProducto = $_POST['idProducto'];
	$cantProducto = $_POST['cantProducto'];
	$unidProducto = $_POST['unidProducto'];

	include('../../mod/conexion.php');

	$consulta = "SELECT * FROM productos WHERE id_producto = $idProducto";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreProducto = $row['nombre_producto']." ".$row['variedad_producto'];
	$precioUnitario = number_format(0, 2, '.', '');
	$totalProducto = number_format(0, 2, '.', '');

	echo "<tr>".
			"<td class='centro'>".$cantProducto."</td>".
			"<td class='centro'>".$unidProducto."</td>".
			"<td>".$nombreProducto."</td>".
			"<td class='derecha'>".$precioUnitario."</td>".
			"<td class='derecha'>".$totalProducto."</td>".
			"<td class='derecha'><a href='#' class='btn btn-danger eliminar-item' data-toggle='tooltip' title='Quitar de la lista'><span class='glyphicon glyphicon-remove'></span></a></td>".
			"<input type='hidden' name='cantidades[]' value='".$cantProducto."'>".
			"<input type='hidden' name='unidades[]' value='".$unidProducto."'>".
			"<input type='hidden' name='idProductos[]' value='".$idProducto."'>".
			"<input type='hidden' name='totalProductos[]' value='".$totalProducto."'>".
		"</tr>";
?>
<script type="text/javascript">
	$('.eliminar-item').tooltip();

	$('.eliminar-item').click(function(){
		var filas = $("#tablaOrden tr").length;
		if(filas > 1){
			var objCuerpo = $(this).parents().get(2);
			if($(objCuerpo).find('tr').length == 1){
				$('#tabla-detalles-orden').hide();
			}

			var objFila = $(this).parents().get(1);
			$(objFila).remove();
		}
	});
</script>