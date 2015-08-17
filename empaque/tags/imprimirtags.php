<div class="contenedor-form">		
	<div class="modal-header">
		<h3 class="modal-title">
			<img class="img-header" src="img/RFID.png"> Impresión de etiquetas
		</h3>
	</div>

	<div style="width:90%; margin: 30px auto">
		<div style="width:45%; float: left">
			<img width="100%" src="img/epc.png">
			<p>&nbsp;</p>
			<div style="width: 100%; background: #ffffff; padding: 10px">
				<table class="table" style="font-size: 14px">
					<tr>
						<td><strong>Tipo EPC</strong></td>
						<td>01</td>
					</tr>
					<tr>
						<td><strong>ID Empaque</strong></td>
						<td>0000001</td>
					</tr>
					<tr>
						<td><strong>ID Fruta</strong></td>
						<td>0000001</td>
					</tr>
					<tr>
						<td><strong>Lote</strong></td>
						<td>0000001</td>
					</tr>
				</table>
				<div style="clear: both"></div>
			</div>
		</div>
		<div style="width:45%; float: right">
			<form id="formulario" class="form-horizontal" role="form" method="post" action="tags/generarTags.php">

	      	<div class="modal-body" style="width:100%; float: left; border-radius: 5px">
	      		<div class="alert alert-info">DETALLES DEL LOTE</div>
	  		
	      		   <div class="form-group">
			    	<label class="col-sm-4 control-label">Número del lote: </label>
			    	<div class="col-sm-7">
			    		<select class="form-control" name="id_lote">
			    			<option>--Seleccionar lote</option>
			    		<?php 
			    			include('../../mod/conexion.php');
							$consulta = "SELECT hex(id_lote) as id_lote, id_lote_fk, epc_caja, fecha_recibo_lote from LOTES left join EPC_CAJA on id_lote = id_lote_fk WHERE id_lote_fk is NULL AND id_empaque_fk = $_SESSION[id_empaque] ORDER BY id_lote DESC";
							$result = mysql_query($consulta);
							if(mysql_num_rows($result) > 0 ){
								 while($row = mysql_fetch_array($result)) {
								 	?>
			    					<option value="<?php print $row['id_lote'] ?>"><?php print str_pad($row['id_lote'],3,"0",STR_PAD_LEFT) . " -- " .$row['fecha_recibo_lote'] ?></option>
						    		<?php } }else{ ?>
						    		<option>No se encuentran lotes</option>

						    		<?php } ?>
			    		</select>
		         	</div>
				  </div>
				  <p class="label label-success">RENDIMIENTO</p>
				 <br><br>
				  <div style="clear: both"></div>
				   <div class="form-group">
			    	<label class="col-sm-3 control-label">Cajas chicas: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas_chicas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	<label class="col-sm-3 control-label">Cajas medianas: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas_medianas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         </div>
		         <div class="form-group">
		         	<label class="col-sm-3 control-label">Cajas grandes: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas_grandes" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	
		         </div>
				  <!--
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Cajas 14kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	<label class="col-sm-3 control-label">Cajas 15kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         </div>
		         <div class="form-group">
		         	<label class="col-sm-3 control-label">Cajas 16kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	<label class="col-sm-3 control-label">Cajas 18kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         </div>
		         <div class="form-group">
		         	<label class="col-sm-3 control-label">Cajas 20kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         	<label class="col-sm-3 control-label">Cajas 25kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cantidad_cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         </div>
		         <div class="form-group">
		         	<label class="col-sm-3 control-label">Cajas 30kg: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="cantidad_cajas" 
			    		placeholder="Rend." required min ="0">
		         	</div>
		         </div>
		     -->
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Rend. kilos: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="rendimiento" 
			    		placeholder="Rend." min="0" required>
		         	</div>
		         	<label class="col-sm-3 control-label">Resaga (kilos): </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="resaga" 
			    		placeholder="Resaga" min="0" required>
		         	</div>
				  </div>
				  <div class="form-group">
			    	<label class="col-sm-3 control-label">Merma 1: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="rendimiento" 
			    		placeholder="merma1" min="0" required>
		         	</div>
		         	<label class="col-sm-3 control-label">Merma 2: </label>
			    	<div class="col-sm-3">
			    		<input type="number" class="form-control input" 
			    		name="resaga" 
			    		placeholder="merma1" min="0" required>
		         	</div>
				  </div>
				   <p class="label label-success">ETIQUETAS</p>
				 <br><br>
				  <div class="form-group">
			    	<label class="col-sm-4 control-label">Etiquetas (RFID): </label>
			    	<div class="col-sm-7">
			    		<input  type="number" min="0" class="form-control input" 
			    		name="numero_etiquetas" 
			    		placeholder="No. etiquetas" required>
		         	</div>
				  </div>
			  	<hr>
			  	<center>
		     			<button id="guardar" class="btn btn-primary"><i  class="glyphicon glyphicon-ok"></i> Generar etiquetas</button>
		     			<input type="hidden" name="url" value="../index.php?op=admon_lotes">
		     	</center>
		     		</div>
		    </form>	
		    <div style="clear: both"></div>
		    <p>&nbsp;</p>
		  </div>
    </div>
	
	 </div>
