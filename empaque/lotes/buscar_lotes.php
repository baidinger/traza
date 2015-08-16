<html>
<head>
<link rel='stylesheet' type='text/css' href='../lib/pagination/css.css'/>
<link rel="stylesheet" type="text/css" href="css/views.css">
</head>
<body>
	<?php 
			$titulo = "Búsqueda de lotes";
			$placeholder="Nombre productor / núm lote";
			$imagen = "lotes.png";
			include("../busquedas/formulario_busqueda.php"); ?>

<div id="data">
	
</div>


<!-- Modal -->
	<div class="modal fade" id="mimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">
					<img class="img-header" src="img/informacion.png"> &nbsp;&nbsp;Información del lote
				</h3>
	      </div>
	      <div id="data-child" class="modal-body">

	        
	      </div>
	    </div>
	  </div>
	</div>

	<?php 
	include("../../mod/conexion.php");
	$consulta = "SELECT * FROM PRODUCTOS ORDER BY nombre_producto ASC, variedad_producto ASC";
	$result = mysql_query($consulta);


	?>

	<div class="modal fade"  id="filtro" role="dialog" >
	  <div class="modal-dialog" style="width: 700px" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title"><div>Búsqueda avanzada</div></h3>
	      </div>
	      <div class="modal-body">
	      	<div class="form-horizontal">
		   	<div class="form-group">
		    	<label class="col-sm-2 control-label">Produto: </label>
			    <div class="col-sm-4">
			    	<select id="producto" class="form-control input">
			      		<option value="0">-- Sin filtro</option>
			      		<?php 
			      		while ($row = mysql_fetch_array($result)) { ?>
			      			<option value="<?php print $row['id_producto'] ?>"><?php print $row['nombre_producto'] . " " . $row['variedad_producto']?></option>
			      <?php	}
			      		?>
			      	</select>
			    </div>
	  		</div>
	  		<div class="form-group">
		    	<label class="col-sm-2 control-label">Núm de cajas: </label>
			    <div class="col-sm-3">
			      	<select id="cajas" onchange="verificar1()" class="form-control input">
			      		<option value="0">--- Sin filtro</option>
			      		<option value="1">Menor que</option>
			      		<option value="2">Igual que</option>
			      		<option value="3">Mayor que</option>
			      		<option value="4">Entre</option>
			      	</select>
			    </div>
			    <div class="col-sm-3">
			      	<input id="cajas_i" disabled class="form-control input" type="number" value="0.0" min="0">
			    </div> 
			    <div class="col-sm-3">
			      	<input id="cajas_f" style="display: none" class="form-control input" type="number" value="0.0" min="0">
			    </div> 
	  		</div>
	  		<div class="form-group">
		    	<label class="col-sm-2 control-label">Núm de kilos: </label>
			    <div class="col-sm-3">
			      	<select id="kilos" onchange="verificar3()" class="form-control input">
			      		<option value="0">--- Sin filtro</option>
			      		<option value="1">Menor que</option>
			      		<option value="2">Igual que</option>
			      		<option value="3">Mayor que</option>
			      		<option value="4">Entre</option>
			      	</select>
			    </div>
			    <div class="col-sm-3">
			      	<input id="kilos_i" disabled class="form-control input" type="number" value="0.0" min="0">
			    </div> 
			    <div class="col-sm-3">
			      	<input id="kilos_f" style="display: none" class="form-control input" type="number" value="0.0" min="0">
			    </div> 
	  		</div>
	  		<div class="form-group">
		    	<label class="col-sm-2 control-label">Costo: </label>
			    <div class="col-sm-3">
			      	<select id="costo" onchange="verificar4()" class="form-control input">
			      		<option value="0">--- Sin filtro</option>
			      		<option value="1">Menor que</option>
			      		<option value="2">Igual que</option>
			      		<option value="3">Mayor que</option>
			      		<option value="4">Entre</option>
			      	</select>
			    </div>
			    <div class="col-sm-3">
			      	<input id="costo_inicio" disabled class="form-control input" type="number" value="0.0" min="0">
			    </div> 
			    <div class="col-sm-3">
			      	<input id="costo_fin" style="display: none" class="form-control input" type="number" value="0.0" min="0">
			    </div> 
	  		</div>
	  		<div class="form-group">
		    	<label class="col-sm-2 control-label">Fecha de recibo: </label>
			    <div class="col-sm-3">
			      	<select id="fecha" onchange="verificar2()" class="form-control input">
			      		<option value="0">--- Sin filtro</option>
			      		<option value="1">Menor que</option>
			      		<option value="2">Igual que</option>
			      		<option value="3">Mayor que</option>
			      		<option value="4">Entre</option>
			      	</select>
			    </div>
			    <div class="col-sm-3">
			      	<input id="fecha_i" value="<?php print date("Y-m-d") ?>" disabled class="form-control input" type="date" min="0">
			    </div> 
			    <div class="col-sm-3">
			      	<input id="fecha_f" value="<?php print date("Y-m-d") ?>" style="display:none" class="form-control input" type="date" min="0">
			    </div> 

	  		</div>

	  		</div>
	  		<div style="clear:both"></div>
	  		<p>&nbsp;</p>
		  </div>
		  <div class="modal-footer">
		  	<center>
			    <button style="width: 150px" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			    <button onclick="aplicar()" style="width: 150px" class="btn btn-primary" data-dismiss="modal">Aplicar</button>
			    <input type="hidden" id="filtro">
		    </center>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript">
		


		function verificar1(){
			//alert("cambio a " + $("#costo").val());
			if($("#cajas").val() == 0)
				$("#cajas_i").attr("disabled","disabled");
			else 
				$("#cajas_i").removeAttr("disabled");

			if($("#cajas").val() == 4)
				$("#cajas_f").css("display","block");
			else
				$("#cajas_f").css("display","none");
		}

		function verificar2(){
			//alert("cambio a " + $("#costo").val());
			if($("#fecha").val() == 0)
				$("#fecha_i").attr("disabled","disabled");
			else 
				$("#fecha_i").removeAttr("disabled");

			if($("#fecha").val() == 4)
				$("#fecha_f").css("display","block");
			else
				$("#fecha_f").css("display","none");
		}

		function verificar3(){
			//alert("cambio a " + $("#costo").val());
			if($("#kilos").val() == 0)
				$("#kilos_i").attr("disabled","disabled");
			else 
				$("#kilos_i").removeAttr("disabled");

			if($("#kilos").val() == 4)
				$("#kilos_f").css("display","block");
			else
				$("#kilos_f").css("display","none");
		}

		function verificar4(){
			//alert("cambio a " + $("#costo").val());
			if($("#costo").val() == 0)
				$("#costo_inicio").attr("disabled","disabled");
			else 
				$("#costo_inicio").removeAttr("disabled");

			if($("#costo").val() == 4)
				$("#costo_fin").css("display","block");
			else
				$("#costo_fin").css("display","none");
		}


		function aplicar(){
			var consulta = "";
			if($("#producto").val() == 0) 
				consulta = "";
			else consulta = " AND id_producto_fk = '" + $("#producto").val() + "'" ;

			switch($("#costo").val())
			{
				case '0': break;
				case '1': consulta += " AND costo_lote < '"+$("#costo_inicio").val()+"'";  break;
				case '2': consulta += " AND costo_lote = '"+$("#costo_inicio").val()+"'";  break;
				case '3': consulta += " AND costo_lote > '"+$("#costo_inicio").val()+"'";  break;
				case '4': consulta += " AND costo_lote > '"+$("#costo_inicio").val()+"' AND costo_lote < '"+$("#costo_fin").val()+"'"; break;
			}

			switch($("#cajas").val())
			{
				case '0': break;
				case '1': consulta += " AND cant_cajas_lote < '"+$("#cajas_i").val()+"'";  break;
				case '2': consulta += " AND cant_cajas_lote = '"+$("#cajas_i").val()+"'";  break;
				case '3': consulta += " AND cant_cajas_lote > '"+$("#cajas_i").val()+"'";  break;
				case '4': consulta += " AND cant_cajas_lote > '"+$("#cajas_i").val()+"' AND cant_cajas_lote < '"+$("#cajas_f").val()+"'"; break;
			}			

			switch($("#kilos").val())
			{
				case '0': break;
				case '1': consulta += " AND cant_kilos_lote < '"+$("#kilos_i").val()+"'";  break;
				case '2': consulta += " AND cant_kilos_lote = '"+$("#kilos_i").val()+"'";  break;
				case '3': consulta += " AND cant_kilos_lote > '"+$("#kilos_i").val()+"'";  break;
				case '4': consulta += " AND cant_kilos_lote > '"+$("#kilos_i").val()+"' AND cant_kilos_lote < '"+$("#kilos_f").val()+"'"; break;
			}

			switch($("#fecha").val())
			{
				case '0': break;
				case '1': consulta += " AND fecha_recibo_lote < '"+$("#fecha_i").val()+"'";  break;
				case '2': consulta += " AND fecha_recibo_lote = '"+$("#fecha_i").val()+"'";  break;
				case '3': consulta += " AND fecha_recibo_lote > '"+$("#fecha_i").val()+"'";  break;
				case '4': consulta += " AND fecha_recibo_lote > '"+$("#fecha_i").val()+"' AND fecha_recibo_lote < '"+$("#fecha_f").val()+"'"; break;
			}
			//alert(consulta);
			$("#filtro").val(consulta);
			buscar();
		}





			function ver(id_lote){

					var params = {'id':id_lote};

					$.ajax({
						type: 'POST',
						url: 'lotes/ver_lote.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
						},
						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
			}

			function editar(id_lote, id_productor){
					var params = {'id':id_lote, 'id_productor': id_productor};

					$.ajax({
						type: 'POST',
						url: 'lotes/editar_lote.php',
						data: params,

						success: function(data){
							$('#data-child').html(data);
						},
						beforeSend: function(data ) {
					    $("#data-child").html("<center><img src=\"img/cargando.gif\"></center>");
					  }
					});
			}

			function buscar(){
				var Buscar = $('#inputBuscar').val();
					var params = {'buscar':Buscar, 'filtro':$('#filtro').val()};
					$.ajax({
						type: 'POST',
						url: 'lotes/coincidencia_lotes.php',
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

			buscar();

		</script>

</body>
</html>