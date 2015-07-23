<?php 
	include("../../mod/conexion.php");
	$usuario = $_POST['usuario'];
	
	if(strcmp($usuario, "") == 0){ ?>
		<span class="label label-danger">Escriba el nombre de usuario</span>
			<script type="text/javascript">
				$("#enviar").attr("disabled", "disabled");
			</script>
	<?php return; }

	$consulta = mysql_query("SELECT * FROM usuarios WHERE nombre_usuario = '$usuario'");

	if($consulta)
	{
		$num = mysql_num_rows($consulta);
		if($num > 0)
		{ ?>
			<span class="label label-danger">No disponible</span>
			<script type="text/javascript">
				$("#enviar").attr("disabled", "disabled");
			</script>
		<?php } else { ?>
			<span class="label label-success">disponible</span>
			<script type="text/javascript">
				$("#enviar").removeAttr("disabled");
			</script>
		<?php } 
	}
	mysql_close($conexion);

 ?>

 