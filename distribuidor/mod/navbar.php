<?php
	@session_start();

	include('../../mod/conexion.php');

	$consulta = "SELECT nombre_usuario_distribuidor FROM usuario_distribuidor WHERE id_usuario_fk = ".$_SESSION['id_usuario'];
	$resultado = mysql_query($consulta);
	$row = mysql_fetch_array($resultado);
	$nombreUsuario = $row['nombre_usuario_distribuidor'];
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  	<div class="navbar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
      		<span class="sr-only">Toggle navigation</span>
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
					<li><a href="../entradasOrdenes/">Entrada de órdenes</a></li>
					</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;Pedidos <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="../nuevoEnvio/">Registrar envío</a></li>
					<li class="divider"></li>
		            <li><a href="../pedidos/">Historial de pedidos</a></li>
					<li><a href="../enviosPedidos/">Envío de pedidos</a></li>
				</ul>
			</li>
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
            		<li><a href="../contrasena/"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
            		<li><a href="../datosGenerales/"><span class="fui-gear"></span> &nbsp;Datos generales</a></li>
            		<li class="divider"></li>
            		<li><a href="../../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
          		</ul>
	        </li>
	    </ul>
  	</div>
</nav>