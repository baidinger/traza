<?php 
	@session_start();

	if(!isset($_SESSION['tipo_socio']))
		header('Location: ../../');

	if(!isset($_POST['orden']))
		header('Location: ../../');
?>

 <?php
 	$idPuntoVenta = $_POST['pv'];

 	include('paises.php');
	$paises = new Paises();

	include('../mod/conexion.php');

	// DATOS DEL PUNTO DE VENTA
	$consulta = "SELECT * FROM empresa_punto_venta WHERE id_punto_venta = $idPuntoVenta";
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);

	$nombrePuntoVenta = $row['nombre_punto_venta'];
	$rfcPuntoVenta = $row['rfc_punto_venta'];
	$paisPuntoVenta = $paises->obtenerPais($row['pais_punto_venta']);
	$estadoPuntoVenta = $paises->obtenerEstado($row['pais_punto_venta'], $row['estado_punto_venta']);
	$ciudadPuntoVenta = $row['ciudad_punto_venta'];
	$direccionPuntoVenta = $row['direccion_punto_venta'];
	$cpPuntoVenta = $row['cp_punto_venta'];
	$tel1PuntoVenta = $row['telefono_punto_venta'];
	$emailPuntoVenta = $row['email_punto_venta'];

	mysql_close();

	require('../lib/fpdf/fpdf.php');

	class PDF extends FPDF {

		function encabezado($nomPV){
			$this->SetFont('Arial', 'B', 18);
			$this->Cell(196, 10, 'RELACIÓN DE USUARIOS', 0, 0, 'C');

			$this->Ln();

			$this->SetFont('Arial', 'B', 9);
			$this->Cell(196, 5, $nomPV, 0, 0, 'C');

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

		function datosEmpresa($nomDist, $rfcDist, $dirDist, $cpDist, $paisDist, $edoDist, $ciuDist, $tel1Dist, $emailDist){
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

		function listaUsuarios($idPV){
			$this->SetFont('Arial', 'B', 8);
			$this->Cell(196, 4, 'LISTA DE USUARIOS', 0, 0, 'L');

			$this->Ln();
			$this->Ln();

			$this->SetTextColor(255, 255, 255);
			$this->SetFillColor(28, 124, 176);
			$this->SetFont('Arial', 'B', 9);

			$this->Cell(10, 6, 'NO.', 1, 0, 'C', 1);
			$this->Cell(96, 6, 'NOMBRE', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'USUARIO', 1, 0, 'C', 1);
			$this->Cell(20, 6, 'TIPO', 1, 0, 'C', 1);
			$this->Cell(30, 6, 'TELÉFONO', 1, 0, 'C', 1);
			$this->Cell(10, 6, 'EDO', 1, 0, 'C', 1);

			$this->SetTextColor(0, 0, 0);
			$this->SetFont('Arial', '', 9);
			$this->Ln();

			include('../mod/conexion.php');

			$contador = 1;

			$consulta = "SELECT usus.id_usuario, usudist.id_usuario_pv, usudist.nombre_usuario_pv, usudist.apellidos_usuario_pv, usus.nombre_usuario, usus.nivel_autorizacion_usuario, usudist.direccion_usuario_pv, usudist.telefono_usuario_pv, usus.estado_usuario FROM usuario_punto_venta AS usudist, usuarios AS usus WHERE usudist.id_punto_venta_fk = $idPV AND usudist.id_usuario_fk = usus.id_usuario ORDER BY usudist.nombre_usuario_pv ASC";
			$resultado = mysql_query($consulta);
			while($row = mysql_fetch_array($resultado)){
				$this->SetTextColor(0, 0, 0);

				$tipo = $row['nivel_autorizacion_usuario'];

  				switch($tipo) {
  					case '1': $tipo = "ADMIN"; break;
  					case '2': $tipo = "NORMAL"; break;
  				}

				$this->Cell(10, 5, $contador, 1, 0, 'C', 0);
				$this->Cell(96, 5, $row['nombre_usuario_pv']." ".$row['apellidos_usuario_pv'], 1, 0, 'L', 0);
				$this->Cell(30, 5, $row['nombre_usuario'], 1, 0, 'L', 0);
				$this->Cell(20, 5, $tipo, 1, 0, 'C', 0);
				$this->Cell(30, 5, $row['telefono_usuario_pv'], 1, 0, 'C', 0);

				if($row['estado_usuario'] == 1){
					$this->SetTextColor(4, 180, 95);
					$this->Cell(10, 5, 'A', 1, 0, 'C');
				}
				else{
					$this->SetTextColor(166, 13, 13);
					$this->Cell(10, 5, 'B', 1, 0, 'C');
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

	$pdf->encabezado($nombrePuntoVenta);
	$pdf->datosEmpresa($nombrePuntoVenta, $rfcPuntoVenta, $direccionPuntoVenta, $cpPuntoVenta, $paisPuntoVenta, $estadoPuntoVenta, $ciudadPuntoVenta, $tel1PuntoVenta, $emailPuntoVenta);
	$pdf->listaUsuarios($idPuntoVenta);

	$directorio = '../docs/';

	if(!file_exists($directorio))
	    mkdir($directorio);

	$pdf->Output($directorio.'usuariospuntoventa'.$idPuntoVenta.'.pdf', "F");
 ?>