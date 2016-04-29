function post_form(){
	var formulario = $("#formIncidencia").serialize();
	$.ajax({
		url: 'incidencias/controlador_incidencias.php',
		type: "POST",
		data: formulario+"&a=crear",
		success: function(data){
			console.log(data);
		}
	});
}
<<<<<<< HEAD
function mostrardetalle(a,id,sizeWidth) {
	if(typeof(sizeWidth) == 'undefined') {
		sizeWidth = 'auto';
	}
=======

function mostrardetalle(a,id){
>>>>>>> 141b4cbdc79a2bbee95135073c5d67f2bfd92d74
	$.ajax({
		url: "incidencias/controlador_incidencias.php",
		type: "POST",
		data: {a: a, idEmpleado:id},
		success: function(data){
			//$( "#dialog-message" ).empty().append(data);
<<<<<<< HEAD
			$("#dialog-message").empty().append(data).dialog({
				modal: true,
				title: a,
				draggable: false,
				resizable: false,
				width: sizeWidth,
				closeText: '',
				buttons: {
					Ok: function() {
						$(this).dialog('destroy');
=======
			$( "#dialog-message" ).empty().append(data).dialog({
				modal: true,
				title: a,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
>>>>>>> 141b4cbdc79a2bbee95135073c5d67f2bfd92d74
					}
				}
			});
		}
	});
<<<<<<< HEAD
}
=======
}
/* GRAFICADOR */
function showSelect(value){
	if (value == 1){
		$('#mes').show();
		$('#incidencia').hide();
	} else {
		$('#mes').hide();
		$('#incidencia').show();
	}
}

function loadGraph() {
	var caso = $('#tipograf').val();
	var id = $('#empleado').val();
	var empresa = $('#idEmp').val();
	var mes;
	var tipoIn;
	if (caso == 1){
		mes = $('#selectMes').val();
		tipoIn = 0;
	} else {
		mes = 0;
		tipoIn = $('#selIncidencia').val();
		tipoIn = tipoIn.split('*3*');
		tipoIn=tipoIn[0];
	}
	request = $.ajax({
		method: 'post',
		url: 'incidencias/infoGrafica.php',
		data:{
			'bandera': caso,
			'empleado': id,
			'fecha': mes,
			'incidencia': tipoIn,
			'empresa': empresa
		},
		success: function(data) {}
	});
	request.done(function(response, textStatus, jqXHR) {
		var obj = jQuery.parseJSON(response);
		console.log(obj);
		switch (caso){
			case '1':
			//alert('ñam');
				var j=0;
				for (var i=0; i<obj.length; i++){
					if (obj[i].data == 0){
						j++
					}
				}
				if (j == obj.length) {
					//alert('No existen reportes de incidencias.');
					noData();
				} else {
					var tipos = [];
					var cantidad=[];
					$.each(obj, function(i, item) {
						console.log(i);
						tipos[i] = item.name;
						cantidad[i] = parseInt(item.data);
					});
					Highcharts.setOptions({
						colors: ['#058DC7', '#50B432', '#ED561B', '#FF9655', '#FFF263']
					});
					$('#grafica').highcharts({
						chart: {
							type: 'column'
						},
						title: {
							text: 'Número de incidencias por empleado'
						},
						xAxis: {
							categories: tipos,
							offset: 5,
							title: {
								text: 'Incidencias',
								align: 'middle',
								margin: 30,
								style: {
									color: 'black',
									fontSize:'13px'
								}
							},
							labels: {
								style: {
									color: 'black',
									fontSize:'12.5px'
								}
							},
						},
						yAxis:{
							title: {
								text: 'Cantidad',
								align: 'middle',
								margin: 30,
								style: {
									color: 'black',
									fontSize:'13px'
								}
							},
							allowDecimals: false,
							offset: 5
						},
						tooltip: {
							borderColor: 'gray'
						},
						legend: {
							enabled: false
						},
						credits: {
							enabled: true,
							href: '',
							text: 'By Padmar Systems. Powered by Highcharts.com'
						},
						series: [{
							name: 'Total',
							data: cantidad
						}]
					});
				}
			break;
			case '2':
				console.log(obj[0]);
				var j=0;
				for (var i=0; i<obj.length; i++){
					if (obj[i] == 0){
						j++
					}
				}
				if (j == obj.length) {
					noData();
				} else {
					var tipos = [];
					var cantidad = [];
					$.each(obj, function(i, item) {
						cantidad[i] = parseInt(item);
					});
					Highcharts.setOptions({
						colors: ['#50B432', '#ED561B', '#FF9655', '#FFF263', '#058DC7']
					});
					$('#grafica').highcharts({
						chart: {
							type: 'column'
						},
						title: {
							text: 'Incidencias en el año actual'
						},
						subtitle: {
							//text: 'hola'
						},
						xAxis: {
							categories: ['Enero', 'Feb', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
							offset: 5,
							labels: {
								style: {
									color: 'black',
									fontSize:'12.5px'
								}
							},
							title: {
								text: 'Mes',
								align: 'middle',
								margin: 30,
								style: {
									color: 'black',
									fontSize:'13px'
								}
							}
							
						},
						yAxis: {
							title: {
								text: 'Incidencias',
								align: 'middle',
								margin: 30,
								style: {
									color: 'black',
									fontSize:'13px'
								}
							},
							allowDecimals: false,
							offset: 5
						},
						tooltip: {
							borderColor: 'gray'
						},
						legend: {
							enabled: false,
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'middle',
							borderWidth: 0
						},
						credits: {
							enabled: true,
							href: '',
							text: 'By Padmar Systems. Powered by Highcharts.com'
						},
						series: [{
							name: 'Total',
							data: cantidad
						}]
					});
				}
			break;
		}
	});
}

function noData(){
	$('#grafica').empty();
	$.ajax({
		url: "incidencias/controlador_incidencias.php",
		type: "POST",
		data: {
			'a': 'Aviso'
		},
		success: function(data){
			$("#dialog-message").empty().append(data).dialog({
				modal: true,
				title: 'Aviso',
				buttons: {
					OK: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	});
}
>>>>>>> 141b4cbdc79a2bbee95135073c5d67f2bfd92d74
