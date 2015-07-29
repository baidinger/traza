<?php
  @session_start();

  if(!isset($_SESSION['tipo_socio'])){
    header('Location: ../');
  }

    include('../mod/conexion.php');
    $consulta = "select pedidos, lotes, envios, superusuario, nombre_empaque, id_empaque, nombre_receptor from usuario_empaque, empresa_empaques where usuario_empaque.id_empaque_fk = empresa_empaques.id_empaque AND usuario_empaque.id_usuario_fk = ".$_SESSION['id_usuario'];
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

     }
     mysql_close();
      ?>
<html>
<head>
	<title>EMPACADORA</title>
	<meta charset="utf-8">
		<script type="text/javascript" src="script/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="script/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="../img/logo_trazabilidad.png" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/settings.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
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
      <a class="navbar-brand titulo" href="index.php">Empaque</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       <!-- <?php if($_SESSION['nivel_socio'] == 1){ ?>
      	
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-th-large"></span>&nbsp;Registrar <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?op=reg_empaque">Empaque</a></li>
            <li><a href="index.php?op=reg_distribuidor">Distribuidor</a></li>
            <li><a href="index.php?op=reg_punto_venta">Punto de venta</a></li>
          </ul>
        </li>
        <?php } ?>-->
         <?php if($_SESSION['nivel_socio'] == 1){ ?>
      	<!-- Administrar cuentas -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Administrar roles <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?op=bus_productor">Productores</a></li>
             <?php if($superusuario == 1) { ?>
            <li><a href="index.php?op=bus_empaque">Empaques</a></li>
            <?php } ?>
            <li><a  href="index.php?op=bus_camion">Camiones</a></li>
            <li><a  href="index.php?op=bus_distribuidor">Distribuidores</a></li>
            <li><a  href="index.php?op=bus_pv">Punto de venta</a></li>
          </ul>
        </li>
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span> &nbsp;Usuarios <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="index.php?op=reg_new_user">Nuevo usuario</a></li>
                <li class="divider"></li>
                    <li><a href="index.php?op=admon_users">Administrar usuarios</a></li>
            </ul>
        </li>
        <?php } ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-apple"></span> &nbsp;Mi empaque <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="index.php?op=asig_pro_empaque">Asignar productos</a></li>
              <?php if($_SESSION['pedidos'] == 1) {?>
              <li><a href="index.php?op=pedidos">Pedidos</a></li>
              <?php } if($_SESSION['envios'] == 1){ ?>
              <li><a href="index.php?op=envios">Envíos</a></li>
               <?php }

              if($_SESSION['lotes'] == 1){ ?>
              <li class="divider"></li>
              <li><a href="index.php?op=reg_lote">Registrar lote</a></li>
             
              <li><a href="index.php?op=admon_lotes">Administrar lotes</a></li>


              <?php }   ?>      
              <li class="divider"></li>
              <li><a href="index.php?op=informacion">Información</a></li>
            </ul>
        </li>
        <?php if($_SESSION['nivel_socio'] == 1){ ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              <span class="glyphicon glyphicon-tags"></span> &nbsp;Etiquetas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
               <li><a href="index.php?op=imprimir">Imprimir</a></li>
               <li><a href="index.php?op=trazabilidad">Trazabilidad</a></li>
            </ul>
        </li>
          <li><a href="#">
          <span class="glyphicon glyphicon-stats"></span> &nbsp;Estadísticas</a></li>
        <?php } ?>
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fui-user"></span> &nbsp;<?php echo $nombre_usuario ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="index.php?op=contrasena"><span class="fui-new"></span> &nbsp;Cambiar contraseña</a></li>
            <li ><a href="index.php?op=datos_generales"><span class="fui-gear"></span> &nbsp;Info. de usuario</a></li>
            <li class="divider"></li>
            <li><a href="../mod/logout.php"><span class="fui-power"></span> &nbsp;Cerrar sesión</a></li>
          </ul>
        </li>
    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div id="views" class="views"></div>


<script>
function $_GET(param)
{
	/* Obtener la url completa */
	url = document.URL;	

	/* Buscar a partir del signo de interrogación ? */
	url = String(url.match(/\?+.+/));

	/* limpiar la cadena quitándole el signo ? */
	url = url.replace("?", "");

	/* Crear un array con parametro=valor */
	url = url.split("&");

	x = 0;

	while (x < url.length)
	{
		p = url[x].split("=");
		if (p[0] == param)
			return decodeURIComponent(p[1]);
		x++;
	}
}

/***** Francisco ****/
if($_GET("op") == "pedidos") 
  $("#views").load("pedidos/");

if($_GET("op") == "asig_pro_empaque") 
  $("#views").load("asignar/asignarProductosEmpaques.php");

if( $_GET("op") == "reg_camion" )
  $("#views").load("registros/registro_camion.php");

if( $_GET("op") == "reg_productor" )
	$("#views").load("registros/registro_productores.php");

if($_GET("op") == "reg_empaque")
  $("#views").load("registros/registro_empresa_empaque.php"); 

if($_GET("op") == "reg_distribuidor") 
  $("#views").load("registros/registro_empresa_distribuidor.php"); 

if($_GET("op") == "reg_punto_venta") 
  $("#views").load("registros/registro_empresa_punto_venta.php");

if($_GET("op") == "bus_productor") 
  $("#views").load("busquedas/Busc_productore.php");

if($_GET("op") == "bus_empaque") 
  $("#views").load("busquedas/Busc_empaque.php");

if($_GET("op") == "bus_camion") 
  $("#views").load("busquedas/Busc_camion.php");

if($_GET("op") == "bus_distribuidor") 
  $("#views").load("busquedas/Busc_distribuidores.php");

if($_GET("op") == "bus_pv") 
  $("#views").load("busquedas/Busc_punto_venta.php");

/***** Alfonso *****/
if($_GET("op") == "contrasena") 
  $("#views").load("contrasena/index.php");

if($_GET("op") == "reg_new_user") 
  $("#views").load("usuarios/registro_nuevo_usuario.php");

if($_GET("op") == "imprimir") 
  $("#views").load("tags/imprimirtags.php");

if($_GET("op") == "trazabilidad") 
  $.ajax({
      type: 'POST',
      url: 'tags/traza.php',
      data: {'epc':$_GET("epc")},

      success: function(data){
        $('#views').html(data);
      }
    });

//  $("#views").load("tags/traza.php");


if($_GET("productor")){
    $.ajax({
      type: 'POST',
      url: 'busquedas/verProductor.php',
      data: {'id':$_GET("productor")},

      success: function(data){
        $('#views').html(data);
      }
    });
}
  //$("#views").load("busquedas/verProductor.php?productor=".$_GET("productor"));

if($_GET("op") == "admon_users") 
  $("#views").load("usuarios/buscar_usuarios_empaque.php");

if($_GET("op") == "reg_lote") 
  $("#views").load("lotes/registro_nuevo_lote.php");

if($_GET("op") == "admon_lotes") 
  $("#views").load("lotes/buscar_lotes.php");

if($_GET("op") == "datos_generales") 
  $("#views").load("datosGenerales/index.php");

if($_GET("op") == "envios") 
  $("#views").load("envios/index.php");

if($_GET("op") == "caja_traza") {
  epc = $_GET("epc_caja");
  $("#views").load("envios/trazabilidadCajas.php?epc_caja="+epc);
}

</script>
<span style="float: right; position: fixed; bottom: 10px; right: 10px" class="label label-success">Versión: 1.3,  fec. mod. 05/07/15</span>
</body>
</html>
