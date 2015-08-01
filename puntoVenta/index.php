<?php
	@session_start();

	if(!isset($_SESSION['tipo_socio'])){
		header('Location: ../');
	}
	else{
		switch($_SESSION['tipo_socio']) {
			case 1: header('Location: ../productor/');
					break;
			case 2: header('Location: ../empaque/');
					break;
			case 3: header('Location: ../distribuidor/');
					break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Trazabilidad</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" type="text/css" href="../lib/bootstrap-3.3.5/css/bootstrap.min.css">
		<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	</head>

	<body class="fondo-body">
		<?php 
			include('../mod/conexion.php');

			$consulta = "SELECT nombre_usuario_pv FROM usuario_punto_venta WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
			$resultado = mysql_query($consulta);
			$row = mysql_fetch_array($resultado);
			$nombreUsuario = $row['nombre_usuario_pv'];
		?>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-01" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand">PUNTO DE VENTA</a>
				</div>
			  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
			  		<ul class="nav navbar-nav">
						<li class="dropdown">
	  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Órdenes <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
	    						<li><a href="nuevaOrden/">Nueva orden</a></li>
	    						<li class="divider"></li>
					            <li><a href="historialOrdenes/">Historial de órdenes</a></li>
								<li><a href="entradasOrdenes/">Entrada de órdenes</a></li>
	  						</ul>
						</li>
						<li><a href="estadisticas/"><span class="glyphicon glyphicon-stats"></span> &nbsp;Estadísticas</a></li>
						<?php
							if($_SESSION['nivel_socio'] == 1){ ?>
								<li class="dropdown">
			  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
			    						<li><a href="nuevoUsuario/">Nuevo usuario</a></li>
			    						<li class="divider"></li>
							            <li><a href="usuarios/">Administrar usuarios</a></li>
			  						</ul>
								</li>
							<?php }
						?>
			    	</ul>

			    	<ul class="nav navbar-nav navbar-right">
				        <li class="dropdown">
				          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $nombreUsuario; ?> <span class="caret"></span></a>
			          		<ul class="dropdown-menu" role="menu">
			          			<li><a href="datosPV/"><span class="fui-gear"></span> &nbsp;Datos del punto de venta</a></li>
			          			<li class="divider"></li>
			            		<li><a href="contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
			            		<li><a href="datosUsuario/"><span class="fui-gear"></span> &nbsp;Datos del usuario</a></li>
			            		<li class="divider"></li>
			            		<li><a href="../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
			          		</ul>
				        </li>
				    </ul>
			  	</div>
			</nav>
		</div>

		<script type="text/javascript" src="../lib/jquery/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>