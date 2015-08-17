<?php
  @session_start();

  if(!isset($_SESSION['tipo_socio'])){
    header('Location: ../../');
  }

    include('../../mod/conexion.php');
    $consulta = "select id_receptor, pedidos, lotes, envios, superusuario, nombre_empaque, id_empaque, nombre_receptor from usuario_empaque, empresa_empaques where usuario_empaque.id_empaque_fk = empresa_empaques.id_empaque AND usuario_empaque.id_usuario_fk = ".$_SESSION['id_usuario'];
    $_empaque = mysql_query($consulta);
     if($row = mysql_fetch_array($_empaque)) {
      /**** privilegios ****/
       $_SESSION['pedidos'] = $row['pedidos'];
       $_SESSION['envios'] = $row['envios'];
       $_SESSION['lotes'] = $row['lotes'];
       $superusuario = $row['superusuario'];
       $_SESSION['superusuario'] = $superusuario;

      /******/
       $_SESSION['nombre_empaque'] = $row['nombre_empaque'];
       $_SESSION['id_empaque'] = $row['id_empaque'];

       $nombre_usuario = $row['nombre_receptor'];
       $_SESSION['id_receptor'] = $row['id_receptor'];

     }
     mysql_close();
      ?>
<html>
<head>
	<title>EMPACADORA</title>
	<meta charset="utf-8">
		<script type="text/javascript" src="../script/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../script/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../lib/google/jsapi.js"></script>
    <link rel="icon" type="image/png" href="../../img/logo_trazabilidad.png" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/settings.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
</head>
<body class="fondo">
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand titulo" href="../index.php">Empaque</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
         <?php if($_SESSION['nivel_socio'] == 1){ ?>
      	<!-- Administrar cuentas -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Administrar roles <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../index.php?op=bus_productor">Productores</a></li>
             <?php if($superusuario == 1) { ?>
            <li><a href="../index.php?op=bus_empaque">Empaques</a></li>
            <?php } ?>
            <li><a  href="../index.php?op=bus_camion">Camiones</a></li>
            <li><a  href="../index.php?op=bus_distribuidor">Distribuidores</a></li>
            <li><a  href="../index.php?op=bus_pv">Puntos de venta</a></li>
          </ul>
        </li>
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <!--<li><a href="index.php?op=reg_new_user">Nuevo usuario</a></li>-->
                <!--<li class="divider"></li>-->
                    <li><a href="../index.php?op=admon_users">Administrar usuarios</a></li>
            </ul>
        </li>
        <?php } ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-apple"></span> &nbsp;Mi empaque <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php if($_SESSION['nivel_socio'] == 1) { ?>
              <li><a href="../index.php?op=asig_pro_empaque">Asignar productos</a></li>
              <li class="divider"></li>
              <?php } ?>
              <?php if($_SESSION['pedidos'] == 1) {?>
              <li><a href="../index.php?op=pedidos">Pedidos</a></li>
              <?php } if($_SESSION['envios'] == 1){ ?>
              <li><a href="../index.php?op=envios">Envíos</a></li>
               <?php }

              if($_SESSION['lotes'] == 1){ ?>
              <li class="divider"></li>
              <!--<li><a href="index.php?op=reg_lote">Registrar lote</a></li>-->
             
              <li><a href="../index.php?op=admon_lotes">Administrar lotes</a></li>


              <?php }   ?>      
              <li class="divider"></li>
              <li><a href="../index.php?empaque=<?php print $_SESSION['id_empaque'] ?>">Información</a></li>
            </ul>
        </li>
        <?php if($_SESSION['nivel_socio'] == 1){ ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-tags"></span> &nbsp;Etiquetas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
               <li><a href="../index.php?op=imprimir">Cajas</a></li>
               <li><a href="../index.php?op=palets">Palets</a></li>
               <li><a href="../tags/">Trazabilidad</a></li>
            </ul>
        </li>
          <li><a href="../index.php?op=estadisticas">
          <span class="glyphicon glyphicon-stats"></span> &nbsp;Estadísticas</a></li>
        <?php } ?>
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $nombre_usuario ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="../index.php?op=contrasena"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
            <li ><a href="../index.php?usuarioemp=<?php print $_SESSION['id_receptor'] ?>"><span class="fui-gear"></span> &nbsp;Info. de usuario</a></li>
            <li class="divider"></li>
            <li><a href="../../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
          </ul>
        </li>
    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id="views" class="views">

<?php
	include("../../trazabilidad/index.php")
?>

</div>
<span style="float: right; position: fixed; bottom: 10px; right: 10px" class="label label-success">Sistema para la Trazabilidad Agrícola Versión: 1.4,  fec. mod. 2/08/15</span>
</body>
</html>
