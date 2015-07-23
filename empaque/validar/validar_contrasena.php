<?php 
	include("../../mod/conexion.php");
	$usuario = $_POST['usuario'];
	$contra = $_POST['contra'];
	
	if(strcmp($contra, "") == 0){ ?>
		<span class="label label-danger">Escriba la contraseña</span>
			<script type="text/javascript">
				$("#btn-cambiar").attr("disabled", "disabled");
			</script>
	<?php return; }

	$consulta = mysql_query("SELECT * FROM usuarios WHERE id_usuario = $usuario and contrasena_usuario = '".md5($contra)."'");

	if($consulta)
	{
		$num = mysql_num_rows($consulta);
		if($num == 0)
		{ ?>
			<span class="label label-danger">No coincide</span>
			<script type="text/javascript">
				$("#btn-cambiar").attr("disabled", "disabled");
			</script>
		<?php } else { ?>
			<span class="label label-success">Coincide</span>
			<script type="text/javascript">
				$("#btn-cambiar").removeAttr("disabled");
			</script>
		<?php } 
	}
	mysql_close($conexion);

 ?>

 