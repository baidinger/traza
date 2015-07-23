<script type="text/javascript">
		mexico();

		function obtenerPais(i){
			if(i == 0) "MEXICO"; 
			if(i == 1) "ESTADOS UNIDOS"; 
			if(i == 2) "CANADÁ"; 
			if(i == 3) "JAPÓN"; 
			if(i == 4) "AUSTRALIA"; 
		}

		function seleccionar(pais, estado){
			document.forms.formulario.pais.selectedIndex = pais;
			if(pais == 0) mexico(); 
			if(pais == 1) eeuu();
			if(pais == 2) canada();
			if(pais == 3) japon();
			if(pais == 4) australia();
			document.forms.formulario.estado.selectedIndex = estado;	
		}

		function cambiar()
		{
		var index = document.forms.formulario.pais.selectedIndex;

		formulario.estado.length=0;

			if(index == 0) mexico(); 
			if(index == 1) eeuu();
			if(index == 2) canada();
			if(index == 3) japon();
			if(index == 4) australia();
		}

			function mexico()
			{
				var estados = ["AGUASCALIENTES", "BAJA CALIFORNIA NORTE", "BAJA CALIFORNIA SUR","CAMPECHE","COAHUILA","CHIAPAS","CHIHUAHUA","DURANGO","ESTADO DE MEXICO","GUANAJUATO","GUERRERO","HIDALGO","JALISCO","MICHOACÁN","MORELOS","MÉXICO D.F.","NAYARIT","NUEVO LEÓN","OAXACA","PUEBLA","QUERETARO","QUINTANA ROO","SAN LUIS POTOSÍ","SINALOA","SONORA","TABASCO","TAMAULIPAS","TLAXCALA","VERACRUZ","YUCATÁN","ZACATECAS"];

				for (var i = 0; i < estados.length; i++) {
					document.forms.formulario.estado.options[i] = new Option(estados[i], estados[i]);
					document.forms.formulario.estado.options[i].value = i;
					};
			}	


			function eeuu()
			{

			var estados = ["ALABAMA","ALASKA","ARIZONA","ARKANSAS","CALIFORNIA","CALIFORNIA DEL NORTE","CAROLINA DEL SUR","COLORADO","CONNECTICUT","DAKOTA DEL NORTE","DAKOTA DEL SUR","DELAWARE","FLORIDA","GEORGIA","HAWÁI","IDAHO","ILLINOIS","INDIANA","IOWA","KANSAS","KENTUCHY","LUISIANA","MAINE","MARYLAND","Massachusetts","MICHIGAN","MINNESOTA","MISISIPI","MISURI","MONTANA","NEBRASKA","NEVADA","NUEVA JERSEY","NUEVA YORK","NUEVO HAMPSHIRE","NUEVO MEXICO","OHIO","OKLAHOMA","OREGÓN","PENSILVANIA","RHODE ISLAND","TENNESSEE","TEXAS","UTAH","VERMONT","VIRGINIA","VIRGINIA OCCIDENTAL","WASHINGTON","WISCONSIN","WYOMING"];

			for (var i = 0; i < estados.length; i++) {
				document.forms.formulario.estado.options[i] = new Option(estados[i], estados[i]);
					document.forms.formulario.estado.options[i].value = i;
				};
			}


			function canada()
			{

			var estados = ["ALBERTA","COLUMBIA BRITANICA","MANITOBA","ISLA DEL PRINCIPE EDUARDO","NUNAVUT5","NUEVA ESCOCIA","NUEVO BRUNSWICK","TERRANOVA Y LABRADOR","TERRITORIOS DEL NOROESTE","SASKATCHEWAN","QUEBEC","YÚKON5"];

			for (var i = 0; i < estados.length; i++) 
			{
				document.forms.formulario.estado.options[i] = new Option(estados[i], estados[i]);
					document.forms.formulario.estado.options[i].value = i;
			};
			}

			function japon()
			{

			var estados = ["PREFECTURA DE HOKKAIDO","PREFECTURA DE AOMORI","PREFECTURA DE IWATE","PREFECTURA DE MIYAGI","PREFECTURA DE AKITA","PREFECTURA DE YAMAGATA","PREFECTURA DE FUKUSHIMA","PREFECTURA DE IBARAKI","PREFECTURA DE TOCHIGI","PREFECTURA DE GUNMA","PREFECTURA DE SAITAMA","PREFECTURA DE CHIBA","TOKIO","PREFECTURA DE KANAWA","PREFECTURA DE NIIGATA","PREFECTURA DE TOYAMA","PREFECTURA DE ISHIKAWA","PREFECTURA DE FUKUI","PREFECTURA DE YAMANASHI","PREFECTURA DE NAGANO","PREFECTURA DE GIFU","PREFECTURA DE SHIZUOKA","PREFECTURA DE AICHI","PREFECTURA DE MIE","PREFECTURA DE SHIGA","PREFECTURA DE KIOTO","PREFECTURA DE OSAKA","PREFECTURA DE HYOGO","PREFECTURA DE NARA","PREFECTURA DE WAKAYAMA","PREFECTURA DE TOTTORI","PREFECTURA DE SHIMANE","PREFECTURA DE OKAYAMA","PREFECTURA DE HIROSHIMA","PREFECTURA DE YAMAGUCHI","PREFECTURA DE TOKUSHIMA","PREFECTURA DE KAGAWA","PREFECTURA DE EHIME","PREFECTURA DE KOCHI","PREFECTURA DE FUKUOKA","PREFECTURA DE SAGA","PREFECTURA DE NAGASAKI","PREFECTURA DE KUMAMOTO","PREFECTURA DE OITA","PREFECTURA DE MIYASAKI","PREFECTURA DE KAGOSHIMA","PREFECTURA DE OKINAWA"];

			for (var i = 0; i < estados.length; i++) 
			{
				document.forms.formulario.estado.options[i] = new Option(estados[i], estados[i]);
					document.forms.formulario.estado.options[i].value = i;
			};
			}
			

			function australia()
			{
			var estados = ["NEW SOUTH WALES","TASMANIA","SOUTH AUSTRALIA","QUEENSLAND","WESTERN AUSTRALIA"];

			for (var i = 0; i < estados.length; i++) 
			{
				document.forms.formulario.estado.options[i] = new Option(estados[i], estados[i]);
					document.forms.formulario.estado.options[i].value = i;
			};
			}
		</script>