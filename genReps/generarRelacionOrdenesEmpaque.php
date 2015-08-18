<?php 
	@session_start();

	if(!isset($_SESSION['tipo_socio']))
		header('Location: ../../');

	if(!isset($_POST['orden']))
		header('Location: ../../');
?>

 <?php
 	include('paises.php');
	$paises = new Paises();

	include('../mod/conexion.php');

	// DATOS DEL DISTRIBUIDOR
	$consulta = "SELECT * FROM empresa_empaques WHERE id_empaque = $_SESSION[id_empaque]";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombreDistribuidor = $row['nombre_empaque'];
	$rfcDistribuidor = $row['rfc_empaque'];
	$paisDistribuidor = $paises->obtenerPais($row['pais_empaque']);
	$estadoDistribuidor = $paises->obtenerEstado($row['pais_empaque'], $row['estado_empaque']);
	$ciudadDistribuidor = $row['ciudad_empaque'];
	$direccionDistribuidor = $row['direccion_empaque'];
	$cpDistribuidor = $row['cp_empaque'];
	$tel1Distribuidor = $row['telefono1_empaque'];
	$tel2Distribuidor = $row['telefono2_empaque'];
	$emailDistribuidor = $row['email_empaque'];

	mysql_close();

	require('../lib/fpdf/fpdf.php');

	class PDF extends FPDF {

		function encabezado($nomDist){
			$this->SetFont('Arial', 'B', 18);
			$this->Cell(196, 10, 'RELACIÓN DE PEDIDOS', 0, 0, 'C');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(196, 5, $nomDist, 0, 0, 'C');

			$this->Ln();
			$this->Ln();
			$this->Ln();

			date_default_timezone_set("America/Mexico_City");
			$fechaImpresion = date("d/m/Y");

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(170, 4, 'Fecha de impresión:', 0, 0, 'R');
			$this->SetFont('Arial', '', 9);
			$this->Cell(26, 4, $fechaImpresion, 0, 0, 'R');

			$this->Ln();
			$this->Ln();
			$this->Ln();
		}

		function datosEmpresa($nomDist, $rfcDist, $dirDist, $cpDist, $paisDist, $edoDist, $ciuDist, $tel1Dist, $tel2Dist, $emailDist){
			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 10);

			$this->Cell(196, 6, 'DATOS DE LA EMPRESA', 1, 0, 'C', 1);

			$this->Ln();

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMPRESA:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $nomDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'RFC:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $rfcDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'DIRECCIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $dirDist.' C.P. '.$cpDist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'UBICACIÓN:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $ciuDist.', '.$edoDist.', '.$paisDist, 1, 0, 'L');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'TELÉFONO(S):', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $tel1Dist.' / '.$tel2Dist, 1, 0, 'L');

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(30, 5, 'EMAIL:', 1, 0, 'L');
			$this->SetFont('Arial', '', 9);
			$this->Cell(68, 5, $emailDist, 1, 0, 'L');

			$this->Ln();
			$this->Ln();
		}

		function listaUsuarios($idDist){
			$this->SetFont('Arial', 'B', 8);
			$this->Cell(196, 4, 'LISTA DE CAMIONES', 0, 0, 'L');

			$this->Ln();
			$this->Ln();

			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 9);

			$this->Cell(10, 6, 'NO.', 1, 0, 'C', 1);
			$this->Cell(25, 6, 'ID', 1, 0, 'C', 1);
			$this->Cell(80, 6, 'NOMBRE DEL DISTRIBUIDOR', 1, 0, 'C', 1);
			$this->Cell(26, 6, 'FECHA', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'COSTO', 1, 0, 'C', 1);
			$this->Cell(25, 6, 'EDO.', 1, 0, 'C', 1);

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', '', 9);
			$this->Ln();

			include('../mod/conexion.php');

			$contador = 1;

			$consulta = "SELECT * FROM ordenes_distribuidor, usuario_distribuidor, empresa_distribuidores WHERE id_usuario_distribuidor = id_usuario_distribuidor_fk AND id_distribuidor = id_distribuidor_fk AND id_empaque_fk = $_SESSION[id_empaque] ORDER BY id_orden DESC";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){
				$this->SetTextColor(0, 0, 0);

				$this->Cell(10, 5, $contador, 1, 0, 'C', 0);
				$this->Cell(25, 5, str_pad($row['id_orden'],10,"0",STR_PAD_LEFT), 1, 0, 'C', 0);
				$this->Cell(80, 5, $row['nombre_distribuidor'], 1, 0, 'L', 0);
				$this->Cell(26, 5, $row['fecha_orden'], 1, 0, 'C', 0);
				$this->Cell(30, 5, "$ ".$row['costo_orden'], 1, 0, 'R', 0);

				if($row['estado_orden'] == 1){
					$this->Cell(25, 5, 'PENDIENTE', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 2){
					$this->Cell(25, 5, 'RECH. EMP.', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 3){
					$this->Cell(25, 5, 'ENVIADO', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 4){
					$this->Cell(25, 5, 'CONCRETADO', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 5){
					$this->Cell(25, 5, 'CANC. EMP.', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 6){
					$this->Cell(25, 5, 'APROBADO', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 7){
					$this->Cell(25, 5, 'PRE-ENVIO', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 8){
					$this->Cell(25, 5, 'CANC. DIST', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 9){
					$this->Cell(25, 5, 'RECH. DIST', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 10){
					$this->Cell(25, 5, 'CANC. P. V', 1, 0, 'C');
				}
				else if($row['estado_orden'] == 11){
					$this->Cell(25, 5, 'RECH. P. V', 1, 0, 'C');
				}

				$this->Ln();
				$contador++;
			}

			mysql_close();
		}
	}

	$pdf = new PDF('P', 'mm', 'letter');

	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->encabezado($nombreDistribuidor);
	$pdf->datosEmpresa($nombreDistribuidor, $rfcDistribuidor, $direccionDistribuidor, $cpDistribuidor, $paisDistribuidor, $estadoDistribuidor, $ciudadDistribuidor, $tel1Distribuidor, $tel2Distribuidor, $emailDistribuidor);
	$pdf->listaUsuarios($idDistribuidor);

	$directorio = '../docs/';

	if(!file_exists($directorio))
	    mkdir($directorio);

	$pdf->Output($directorio.'ordenesempaque'.$_SESSION['id_empaque'].'.pdf', "F");
 ?>