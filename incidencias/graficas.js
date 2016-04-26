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
		//console.log(obj);
		switch (caso){
			case '1':
			//alert('ñam');
			var j=0;
				for ( var i=0; i<obj.length; i++){
					if (obj[i].data == 0){
						j++
					}
				}
				if (j == obj.length) {
					$('#grafica').empty();
					alert('No existen incidencias.');
				} else {
					var tipos = [];
					var cantidad=[];
					$.each(obj, function(i, item) {
						console.log(i);
						tipos[i] = item.name;
						cantidad[i] = parseInt(item.data);
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
								margin: 30
							}
						},
						yAxis:{
							title: {
								text: 'Cantidad',
								align: 'middle',
								margin: 30
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
				console.log(obj);
				var tipos = [];
				var cantidad = [];
				$.each(obj, function(i, item) {
					cantidad[i] = parseInt(item);
				});
				
				$('#grafica').highcharts({
					title: {
						text: 'Incidencias en el año actual'
					},
					xAxis: {
						categories: ['Ene', 'Feb', 'Mar', 'Abr', 'Mayo', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
						offset: 5,
						title: {
							text: 'Mes',
							align: 'middle',
							margin: 30
						}
					},
					yAxis: {
						title: {
							text: 'Incidencias',
							align: 'middle',
							margin: 30
						},
						allowDecimals: false,
						offset: 5,
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
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
			break;
			
			case '3':
				console.log(obj);
				var tipos = [];
				var cantidad = [];
				$.each(obj, function(i, item) {
					cantidad[i] = parseInt(item);
				});
				
				$('#grafica').highcharts({
					title: {
						text: 'Incidencias en el año actual'
					},
					xAxis: {
						categories: ['Ene', 'Feb', 'Mar', 'Abr', 'Mayo', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
						offset: 5,
						title: {
							text: 'Incidencias',
							align: 'middle',
							margin: 30
						}
					},
					yAxis: {
						title: {
							text: 'Mes',
							align: 'middle',
							margin: 30
						},
						allowDecimals: false,
						offset: 5,
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
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
			break;
			
		}
	});
}
