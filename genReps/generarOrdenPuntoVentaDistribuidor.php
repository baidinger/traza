<?php 
	@session_start();

	if(!isset($_SESSION['tipo_socio']))
		header('Location: ../../');

	if(!isset($_POST['orden']))
		header('Location: ../../');
?>

 <?php
 	$idOrden = $_POST['orden'];

	include('../mod/conexion.php');

	// DATOS DE LA ORDEN
	$consulta = "SELECT * FROM ordenes_punto_venta WHERE id_orden = $idOrden";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$fechaOrden = $row['fecha_orden'];
	$fechaEntrega = $row['fecha_entrega_orden'];
	$costoOrden = $row['costo_orden'];
	$descripcionOrden = $row['descripcion_orden'];
	$descripcionCancelacion = $row['descripcion_cancelacion'];
	$descripcionRechazo = $row['descripcion_rechazo'];
	$estadoOrden = $row['estado_orden'];

	$idDistribuidor = $row['id_distribuidor_fk'];
	$idUsuarioPuntoVenta = $row['id_usuario_punto_venta_fk'];

	// DATOS DEL DISTRIBUIDOR
	$consulta = "SELECT * FROM empresa_distribuidores WHERE id_distribuidor = $idDistribuidor";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreDistribuidor = $row['nombre_distribuidor'];
	$rfcDistribuidor = $row['rfc_distribuidor'];
	$paisDistribuidor = $row['pais_distribuidor'];
	$estadoDistribuidor = $row['estado_distribuidor'];
	$ciudadDistribuidor = $row['ciudad_distribuidor'];
	$direccionDistribuidor = $row['direccion_distribuidor'];
	$cpDistribuidor = $row['cp_distribuidor'];
	$tel1Distribuidor = $row['tel1_distribuidor'];
	$tel2Distribuidor = $row['tel2_distribuidor'];
	$emailDistribuidor = $row['email_distribuidor'];

	// DATOS DEL PUNTO DE VENTA
	$consulta = "SELECT id_punto_venta_fk FROM usuario_punto_venta WHERE id_usuario_pv = $idUsuarioPuntoVenta";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$idPuntoVenta = $row['id_punto_venta_fk'];

	$consulta = "SELECT * FROM empresa_punto_venta WHERE id_punto_venta = $idPuntoVenta";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombrePuntoVenta = $row['nombre_punto_venta'];
	$rfcPuntoVenta = $row['rfc_punto_venta'];
	$paisPuntoVenta = $row['pais_punto_venta'];
	$estadoPuntoVenta = $row['estado_punto_venta'];
	$ciudadPuntoVenta = $row['ciudad_punto_venta'];
	$direccionPuntoVenta = $row['direccion_punto_venta'];
	$cpPuntoVenta = $row['cp_punto_venta'];
	$tel1PuntoVenta = $row['telefono_punto_venta'];
	$emailPuntoVenta = $row['email_punto_venta'];

	mysql_close();

	require('../lib/fpdf/fpdf.php');

	class PDF extends FPDF {

		function encabezado($orden, $estado, $fOrden, $fEntrega){
			$this->SetFont('Arial', 'B', 18);
			$this->Cell(40, 5, '', 0, 0, 'C');
			$this->Cell(116, 10, 'ORDEN DE COMPRA', 0, 0, 'C');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(40, 5, 'NO. DE ORDEN', 0, 0, 'C');

			$this->Ln();

			$this->SetTextColor(233, 52, 52);
			$this->Cell(156, 5, '', 0, 0, 'C');
			$this->Cell(40, 5, $orden, 0, 0, 'C');

			$this->Ln();
			$this->Ln();

			switch($estado) {
				case 1: $estado = "PENDIENTE"; $this->SetTextColor(233, 200, 51); break;
				case 2: $estado = "RECHAZADO POR EMPAQUE"; $this->SetTextColor(233, 52, 52); break;
				case 3: $estado = "ENVIADO"; $this->SetTextColor(51, 100, 233); break;
				case 4: $estado = "CONCRETADO"; $this->SetTextColor(38, 198, 84); break;
				case 5: $estado = "CANCELADO POR EMPAQUE"; $this->SetTextColor(233, 52, 52); break;
				case 6: $estado = "APROBADO"; $this->SetTextColor(51, 100, 233); break;
				case 7: $estado = "PRE-ENVIO"; $this->SetTextColor(51, 100, 233); break;
				case 8: $estado = "CANCELADO POR DISTRIBUIDOR"; $this->SetTextColor(233, 52, 52); break;
				case 9: $estado = "RECHAZADO POR DISTRIBUIDOR"; $this->SetTextColor(233, 52, 52); break;
				case 10: $estado = "CANCELADO POR PUNTO DE VENTA"; $this->SetTextColor(233, 52, 52); break;
				case 11: $estado = "RECHAZADO POR PUNTO DE VENTA"; $this->SetTextColor(233, 52, 52); break;
				default: $estado = "PENDIENTE"; $this->SetTextColor(233, 200, 51); break;
			}

			$this->SetFont('Arial', 'B', 20);
			$this->Cell(196, 10, $estado, 0, 0, 'C');

			$this->Ln();
			$this->Ln();

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', 'B', 9);
			$this->Cell(170, 4, 'Fecha de creación de la orden:', 0, 0, 'R');
			$this->SetFont('Arial', '', 9);
			$this->Cell(26, 4, $fOrden, 0, 0, 'R');

			$this->Ln();
			
			$this->SetFont('Arial', 'B', 9);
			$this->Cell(170, 4, 'Fecha de entrega:', 0, 0, 'R');
			$this->SetFont('Arial', '', 9);
			$this->Cell(26, 4, $fEntrega, 0, 0, 'R');

			$this->Ln();
			$this->Ln();
			$this->Ln();
		}

		function datosEmpresas($nomPV, $rfcPV, $dirPV, $cpPV, $paisPV, $edoPV, $ciuPV, $tel1PV, $emailPV, $nomDist, $rfcDist, $dirDist, $cpDist, $paisDist, $edoDist, $ciuDist, $tel1Dist, $tel2Dist, $emailDist){
			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 10);

			$this->Cell(98, 6, 'EMPRESA SOLICITANTE', 1, 0, 'C', 1);
			$this->Cell(98, 6, 'EMPRESA SOLICITADA', 1, 0, 'C', 1);

			$this->Ln();

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMPRESA:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $nomPV, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMPRESA:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $nomDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'RFC:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $rfcPV, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'RFC:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $rfcDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'DIRECCIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $dirPV.' C.P. '.$cpPV, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'DIRECCIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $dirDist.' C.P. '.$cpDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'UBICACIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $ciuPV.', '.$edoPV.', '.$paisPV, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'UBICACIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $ciuDist.', '.$edoDist.', '.$paisDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'TELÉFONO:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $tel1PV, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'TELÉFONO(S):', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $tel1Dist.' / '.$tel2Dist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMAIL:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $emailPV, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMAIL:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $emailDist, 1, 0, 'L');

			$this->Ln();
			$this->Ln();
			$this->Ln();
		}

		function textoOrden($nomPV, $fEntrega){
			$texto = "Solicito se me entregue(n) el(los) bienes / servicio(s) que se detallan en la presente ORDEN DE COMPRA a ".$nomPV." el día ".$fEntrega.", en la dirección establecida en la parte superior.";

			$this->SetFont('Arial', '', 9);
			$this->MultiCell(0, 5, $texto);

			$this->Ln();
			$this->Ln();
		}

		function detallesOrden($orden, $descOrden, $descCancelacion, $descRechazo){
			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 9);

			$this->Cell(10, 6, 'NO.', 1, 0, 'C', 1);
			$this->Cell(15, 6, 'CANT', 1, 0, 'C', 1);
			$this->Cell(15, 6, 'UNIDAD', 1, 0, 'C', 1);
			$this->Cell(96, 6, 'DESCRIPCIÓN', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'P. UNITARIO', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'VALOR TOTAL', 1, 0, 'C', 1);

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', '', 9);
			$this->Ln();

			include('../mod/conexion.php');

			$contador = 1;
			$totalOrden = 0;

			$consulta = "SELECT dets.cant_producto_odd, dets.unidad_producto_odd, prods.nombre_producto, prods.variedad_producto, dets.costo_unitario_odd, dets.costo_producto_odd FROM ordenes_punto_venta_detalles AS dets, productos AS prods WHERE id_orden_dist_fk = $orden AND dets.id_producto_fk = prods.id_producto";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){
				$totalOrden += number_format($row['costo_producto_odd'], 2, '.', '');

				$this->Cell(10, 5, $contador, 1, 0, 'C');
				$this->Cell(15, 5, $row['cant_producto_odd'], 1, 0, 'C');
				$this->Cell(15, 5, $row['unidad_producto_odd'], 1, 0, 'C');
				$this->Cell(96, 5, $row['nombre_producto'].' '.$row['variedad_producto'], 1, 0, 'L');
				$this->Cell(5, 5, '$', 'LT', 0, 'L');
				$this->Cell(25, 5, number_format($row['costo_unitario_odd'], '2', '.', ','), 'RT', 0, 'R');
				$this->Cell(5, 5, '$', 'LT', 0, 'L');
				$this->Cell(25, 5, number_format($row['costo_producto_odd'], '2', '.', ','), 'RT', 0, 'R');
				
				$this->Ln();
				$contador++;
			}

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(136, 5, '', 0, 0, 'C');
			$this->Cell(30, 5, 'TOTAL:', 1, 0, 'C');
			$this->Cell(5, 5, '$', 'LTB', 0, 'L');
			$this->Cell(25, 5, number_format($totalOrden, '2', '.', ','), 'RTB', 0, 'R');

			$this->Ln();
			$this->Ln();
			$this->Ln();

			if(!empty($descOrden)){
				$this->SetFont('Arial', 'B', 8);
				$this->Cell(196, 4, 'DESCRIPCIÓN DE LA ORDEN', 0, 0, 'L');

				$this->Ln();

				$this->SetFont('Arial', '', 8);
				$this->MultiCell(0, 4, $descOrden);

				$this->Ln();
				$this->Ln();
			}

			if(!empty($descCancelacion)){
				$this->SetFont('Arial', 'B', 8);
				$this->Cell(196, 4, 'MOTIVO DE CANCELACIÓN', 0, 0, 'L');

				$this->Ln();

				$this->SetFont('Arial', '', 8);
				$this->SetTextColor(233, 52, 52);
				$this->SetFillColor(250, 88, 88);
				$this->MultiCell(0, 4, $descCancelacion);

				$this->Ln();
				$this->Ln();
			}

			if(!empty($descRechazo)){
				$this->SetFont('Arial', 'B', 8);
				$this->Cell(196, 4, 'MOTIVO DE RECHAZO', 0, 0, 'L');

				$this->Ln();

				$this->SetFont('Arial', '', 8);
				$this->SetTextColor(233, 52, 52);
				$this->SetFillColor(250, 88, 88);
				$this->MultiCell(0, 4, $descRechazo);

				$this->Ln();
				$this->Ln();
			}

			$this->SetFont('Arial', 'B', 7);
			$this->SetTextColor(0, 0, 0);
			$this->Cell(196, 3, 'TÉRMINOS Y CONDICIONES', 0, 0, 'L');

			$this->Ln();

			$termimos = "El valor de esta ORDEN DE COMPRA está especificado en pesos mexicanos. Los productos / servicios detallados en esta ORDEN DE COMPRA deberán ser entregados en el lugar y fecha establecidos. La presente ORDEN DE COMPRA tiene validez por tres meses a partir de la recepción de la misma por parte del proveedor, plazo en el que se deberá ejecutarse la misma y realizar el trámite de pago, después de este tiempo la institución no recibirá productos, servicios, ni documentos relacionados con dicha orden.";
			$this->SetFont('Arial', '', 7);
			$this->MultiCell(0, 3, $termimos);

			$this->Ln();
			$this->Ln();

			mysql_close();
		}
	}

	$pdf = new PDF('P', 'mm', 'letter');

	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->encabezado($idOrden, $estadoOrden, $fechaOrden, $fechaEntrega);
	$pdf->datosEmpresas($nombrePuntoVenta, $rfcPuntoVenta, $direccionPuntoVenta, $cpPuntoVenta, $paisPuntoVenta, $estadoPuntoVenta, $ciudadPuntoVenta, $tel1PuntoVenta, $emailPuntoVenta, $nombreDistribuidor, $rfcDistribuidor, $direccionDistribuidor, $cpDistribuidor, $paisDistribuidor, $estadoDistribuidor, $ciudadDistribuidor, $tel1Distribuidor, $tel2Distribuidor, $emailDistribuidor);
	$pdf->textoOrden($nombrePuntoVenta, $fechaEntrega);
	$pdf->detallesOrden($idOrden, $descripcionOrden, $descripcionCancelacion, $descripcionRechazo);

	$directorio = '../docs/';

	if(!file_exists($directorio))
	    mkdir($directorio);

	$pdf->Output($directorio.'ordendecomprapv'.$idOrden.'.pdf', "F");
 ?>