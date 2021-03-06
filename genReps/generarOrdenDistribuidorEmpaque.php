<?php 
	@session_start();

	if(!isset($_SESSION['tipo_socio']))
		header('Location: ../../');

	if(!isset($_POST['orden']))
		header('Location: ../../');
?>

 <?php
 	$idOrden = $_POST['orden'];

 	include('paises.php');
	$paises = new Paises();

	include('../mod/conexion.php');

	// DATOS DE LA ORDEN
	$consulta = "SELECT * FROM ordenes_distribuidor WHERE id_orden = $idOrden";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$fechaOrden = date('d/m/Y', strtotime($row['fecha_orden']));
	$fechaEntrega = date('d/m/Y', strtotime($row['fecha_entrega_orden']));
	$costoOrden = $row['costo_orden'];
	$descripcionOrden = $row['descripcion_orden'];
	$descripcionCancelacion = $row['descripcion_cancelacion'];
	$descripcionRechazo = $row['descripcion_rechazo'];
	$estadoOrden = $row['estado_orden'];

	$idEmpaque = $row['id_empaque_fk'];
	$idUsuarioDistribuidor = $row['id_usuario_distribuidor_fk'];

	// DATOS DEL EMPAQUE
	$consulta = "SELECT * FROM empresa_empaques WHERE id_empaque = $idEmpaque";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreEmpaque = $row['nombre_empaque'];
	$rfcEmpaque = $row['rfc_empaque'];
	$paisEmpaque = $paises->obtenerPais($row['pais_empaque']);
	$estadoEmpaque = $paises->obtenerEstado($row['pais_empaque'], $row['estado_empaque']);
	$ciudadEmpaque = $row['ciudad_empaque'];
	$direccionEmpaque = $row['direccion_empaque'];
	$cpEmpaque = $row['cp_empaque'];
	$tel1Empaque = $row['telefono1_empaque'];
	$tel2Empaque = $row['telefono2_empaque'];
	$emailEmpaque = $row['email_empaque'];

	// DATOS DEL DISTRIBUIDOR
	$consulta = "SELECT id_distribuidor_fk FROM usuario_distribuidor WHERE id_usuario_distribuidor = $idUsuarioDistribuidor";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$idDistribuidor = $row['id_distribuidor_fk'];

	$consulta = "SELECT * FROM empresa_distribuidores WHERE id_distribuidor = $idDistribuidor";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreDistribuidor = $row['nombre_distribuidor'];
	$rfcDistribuidor = $row['rfc_distribuidor'];
	$paisDistribuidor = $paises->obtenerPais($row['pais_distribuidor']);
	$estadoDistribuidor = $paises->obtenerEstado($row['pais_distribuidor'], $row['estado_distribuidor']);
	$ciudadDistribuidor = $row['ciudad_distribuidor'];
	$direccionDistribuidor = $row['direccion_distribuidor'];
	$cpDistribuidor = $row['cp_distribuidor'];
	$tel1Distribuidor = $row['tel1_distribuidor'];
	$tel2Distribuidor = $row['tel2_distribuidor'];
	$emailDistribuidor = $row['email_distribuidor'];

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

		function datosEmpresas($nomDist, $rfcDist, $dirDist, $cpDist, $paisDist, $edoDist, $ciuDist, $tel1Dist, $tel2Dist, $emailDist, $nomEmp, $rfcEmp, $dirEmp, $cpEmp, $paisEmp, $edoEmp, $ciuEmp, $tel1Emp, $tel2Emp, $emailEmp){
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
			$this->Cell(68, 5, $nomDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMPRESA:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $nomEmp, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'RFC:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $rfcDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'RFC:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $rfcEmp, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'DIRECCIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $dirDist.' C.P. '.$cpDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'DIRECCIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $dirEmp.' C.P. '.$cpEmp, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'UBICACIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $ciuDist.', '.$edoDist.', '.$paisDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'UBICACIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $ciuEmp.', '.$edoEmp.', '.$paisEmp, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'TELÉFONO(S):', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $tel1Dist.' / '.$tel2Dist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'TELÉFONO(S):', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $tel1Emp.' / '.$tel2Emp, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMAIL:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $emailDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMAIL:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $emailEmp, 1, 0, 'L');

			$this->Ln();
			$this->Ln();
			$this->Ln();
		}

		function textoOrden($nomDist, $fEntrega){
			$texto = "Solicito se me entregue(n) el(los) bienes / servicio(s) que se detallan en la presente ORDEN DE COMPRA a ".$nomDist." el día ".$fEntrega.", en la dirección establecida en la parte superior.";

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

			$consulta = "SELECT dets.cantidad_producto_od, dets.unidad_producto_od, prods.nombre_producto, prods.variedad_producto, dets.costo_unitario_od, dets.costo_producto_od FROM ordenes_distribuidor_detalles AS dets, productos AS prods WHERE id_orden_fk = $orden AND dets.id_producto_fk = prods.id_producto";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){
				$totalOrden += number_format($row['costo_producto_od'], 2, '.', '');

				$this->Cell(10, 5, $contador, 1, 0, 'C');
				$this->Cell(15, 5, $row['cantidad_producto_od'], 1, 0, 'C');
				$this->Cell(15, 5, $row['unidad_producto_od'], 1, 0, 'C');
				$this->Cell(96, 5, $row['nombre_producto'].' '.$row['variedad_producto'], 1, 0, 'L');
				$this->Cell(5, 5, '$', 'LT', 0, 'L');
				$this->Cell(25, 5, number_format($row['costo_unitario_od'], '2', '.', ','), 'RT', 0, 'R');
				$this->Cell(5, 5, '$', 'LT', 0, 'L');
				$this->Cell(25, 5, number_format($row['costo_producto_od'], '2', '.', ','), 'RT', 0, 'R');
				
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
	$pdf->datosEmpresas($nombreDistribuidor, $rfcDistribuidor, $direccionDistribuidor, $cpDistribuidor, $paisDistribuidor, $estadoDistribuidor, $ciudadDistribuidor, $tel1Distribuidor, $tel2Distribuidor, $emailDistribuidor, $nombreEmpaque, $rfcEmpaque, $direccionEmpaque, $cpEmpaque, $paisEmpaque, $estadoEmpaque, $ciudadEmpaque, $tel1Empaque, $tel2Empaque, $emailEmpaque);
	$pdf->textoOrden($nombreDistribuidor, $fechaEntrega);
	$pdf->detallesOrden($idOrden, $descripcionOrden, $descripcionCancelacion, $descripcionRechazo);

	$directorio = '../docs/';

	if(!file_exists($directorio))
	    mkdir($directorio);

	$pdf->Output($directorio.'ordendecompradist'.$idOrden.'.pdf', "F");
 ?>