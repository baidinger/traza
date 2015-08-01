<?php
	@session_start();

	include('../../mod/conexion.php');

	$consulta = "SELECT nombre_usuario_distribuidor, entradas, pedidos, envios FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);
	$nombreUsuario = $row['nombre_usuario_distribuidor'];
	$privEntradas = $row['entradas'];
	$privPedidos = $row['pedidos'];
	$privEnvios = $row['envios'];
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
				<a href="../" class="navbar-brand">DISTRIBUIDOR</a>
		</div>
  	
	  	<div class="collapse navbar-collapse" id="navbar-collapse-01">
	  		<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Órdenes <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="../nuevaOrden/">Nueva orden</a></li>
						<li class="divider"></li>
			            <li><a href="../historialOrdenes/">Historial de órdenes</a></li>
			            <?php if($privEntradas == 1) { ?>
			            	<li><a href="../entradasOrdenes/">Entrada de órdenes</a></li>
			            <?php } ?>
					</ul>
				</li>
				<?php if($privPedidos == 1) { ?>
	            	<li><a href="../pedidos/"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Pedidos</a></li>
	            <?php } ?>
	            <?php if($privEnvios == 1) { ?>
	            	<li><a href="../envios/"><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Envios</a></li>
	            <?php } ?>
				<li><a href="../productos/"><span class="glyphicon glyphicon-apple"></span> &nbsp;Productos</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-road"></span> &nbsp;Camiones <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="../nuevoCamion/">Agregar camion</a></li>
						<li class="divider"></li>
						<li><a href="../camiones/">Lista de camiones</a></li>
					</ul>
				</li>
				<li><a href="../estadisticas/"><span class="glyphicon glyphicon-stats"></span> &nbsp;Estadísticas</a></li>
				<?php 
					if($_SESSION['nivel_socio'] == 1){ ?>
						<li class="dropdown">
	  						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
	    						<li><a href="../nuevoUsuario/">Nuevo usuario</a></li>
	    						<li class="divider"></li>
					            <li><a href="../usuarios/">Administrar usuarios</a></li>
	  						</ul>
						</li>
					<?php }
				?>
	    	</ul>

	    	<ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $nombreUsuario; ?> <span class="caret"></span></a>
	          		<ul class="dropdown-menu" role="menu">
	          			<li><a href="../datosDist/"><span class="fui-gear"></span> &nbsp;Datos del distribuidor</a></li>
	          			<li class="divider"></li>
	            		<li><a href="../contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
	            		<li><a href="../datosUsuario/"><span class="fui-gear"></span> &nbsp;Datos del usuario</a></li>
	            		<li class="divider"></li>
	            		<li><a href="../../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
	          		</ul>
		        </li>
		    </ul>
	  	</div>
	</div>
</nav>