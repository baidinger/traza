
<html>
<head>
<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
		<style type="text/css"> 
			.modal-header{
				width:100%;
			}

			.contenedor-form{
				width:100%;
			}

			body{
				background: #FFFFFF;
			}

			.fondo-modal-body{
				background: #CEF6CE;
			}

			.views{
				background: #FFFFFF;	
			}

			.busqueda-form{
				margin-top: 20px;
				margin-left: 50px;
				width:1000px;
				float:left;

			}

			.formato{
				font-size: 25px;
				font-weight: bold;
			}

			.active{
				font-weight: bold;
				color:#0B6121;
			}

			.desactive{
				font-weight: bold;
				color:#8A0808;
			}

			.centro{
				text-align: center;
			}
			</style>

</head>
<body>

<div class="contenedor-form">
			
	  		<div class="modal-header">
	    		<h3 class="modal-title">
	    			<img class="img-header" src="img/imagen.png"> Búsqueda de usuarios del empaque
	    		</h3>
	  		</div>

	  	</div>

	  	<div class="busqueda-form">
				<div class="form-group">
			    	<label for="inputBuscar" class="col-sm-2 control-label">Buscar</label>
			    	<div class="col-sm-10">
			      		<input onkeyup="if(event.keyCode == 13) buscar();" type="text" class="form-control" id="inputBuscar" placeholder="Buscar usuario">
			    	</div>
			  	</div>
		</div>

		<div style="float:left; margin-top: 20px; margin-left:10px;">
			<button type="submit" class="btn btn-primary" onclick="buscar()">Buscar</button>
		</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="clear:both"></div>
<div id="data">
	
</div>
	

</body>
<script type="text/javascript">
		
			function buscar(){
				var Buscar = $('#inputBuscar').val();

					var params = {'buscar':Buscar};

					$.ajax({
						type: 'POST',
						url: 'usuarios/buscar_usuarios.php',
						data: params,

						success: function(data){
							$('#data').html(data);
							$('#inputBuscar').select();
						},
						beforeSend: function(data ) {
					    $("#data").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});

			}

			function editar(id_receptor, id_empaque, id_usuario){
					var params = {'id_receptor':id_receptor, 'id_empaque': id_empaque, 'id_usuario': id_usuario};
					$.ajax({
						type: 'POST',
						url: 'usuarios/editar_usuario_empaque.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
						},

						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
			}

			function ver(id_receptor){

					var params = {'id':id_receptor};

					$.ajax({
						type: 'POST',
						url: 'usuarios/ver_receptor.php',
						data: params,

						success: function(data){
							$('#data-child1').html(data);
						},

						beforeSend: function(data ) {
					    $("#data-child1").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					  
					});
			}

			buscar();


		</script>
</html>