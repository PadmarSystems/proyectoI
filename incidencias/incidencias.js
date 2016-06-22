google.charts.load('current', {'packages':['annotationchart', 'corechart'],'language':'es'});
var d = new Date();

function post_form(){
	var resp = validReporte();
	if (resp){
		var formulario = $("#formIncidencia").serialize();
		$.ajax({
			url: 'incidencias/controlador_incidencias.php',
			type: "POST",
			data: formulario+"&a=crear",
			success: function(data){
				$("#dialog-message").empty().append(data).dialog({
					modal: true,
					title: 'Mensaje',
					draggable: false,
					resizable: false,
					width: 'auto',
					closeText: '',
					buttons: {
						OK: function() {
							$(this).dialog('destroy');
							window.location.replace("view.php?com=incidencias&mod=seguimiento");
						}
					}
				});
			}
		});
	}
}
function mostrardetalle(a,id,sizeWidth) {
	if(typeof(sizeWidth) == 'undefined') {
		sizeWidth = 'auto';
	}
	$.ajax({
		url: "incidencias/controlador_incidencias.php",
		type: "POST",
		data: {a: a, idEmpleado:id},
		success: function(data){
			//$( "#dialog-message" ).empty().append(data);
			$("#dialog-message").empty().append(data).dialog({
				modal: true,
				title: a,
				draggable: false,
				resizable: false,
				width: sizeWidth,
				closeText: '',
				buttons: {
					OK: function() {
						$(this).dialog('destroy');
					}
				}
			});
		}
	});
}
function procesar_incidencia(id){
	$.ajax({
		url: "incidencias/controlador_incidencias.php",
		type: "POST",
		data: {a: 'cargar_campos', idTipo:id},
		success: function(data){
			$( "#a-campos" ).empty().append(data);
		}
	});
}
//// VALIDACIÓN
function validReporte(){
	if ( $('#folio').val() == 0 || $('#folio').val() == null || $('#folio').val().length <=1 ){
		alert('El folio no es válido.');
		$('#folio').focus();
		return 0;
	}
	if ( $('#tipoIncidencia').val() == '' || $('#tipoIncidencia').val() == null){
		alert('Seleccione un tipo de incidencia.');
		$('#tipoIncidencia').focus();
		return 0;
	}
	if ( $('#fechaIn').val() == null || $('#fechaIn').val()==''){
		alert('Ingrese la fecha de la incidencia.');
		$('#fechaIn').focus();
		return 0;
	}
	if ( $('#horaIn').val() == null || $('#horaIn').val()==''){
		alert('Ingrese la hora de la incidencia.');
		$('#horaIn').focus();
		return 0;
	}
	if ( $('#motivo').val() == null || $('#motivo').val()==''){
		alert('Ingrese los detalles o el motivo de la incidencia.');
		$('#motivo').focus();
		return 0;
	}
	return 1;
}
//// AVISO
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
						$( this ).dialog("close");
					}
				}
			});
		}
	});
}
//// GRÁFICAS
function chgnVal(value){
	$('#boton').val(value);
	showSelect(value);
}
function showSelect(value){
	console.log("corrección de año (2015 a actual)");
	switch (value){
		case '1':
			$('#incidencia').show(300);
			$('#mes').hide(500);
			$('#empleado').hide(500);
			$('#responsables').hide(500);
			$('#ubicaciones').hide(500);
		break;
		case '2':
			$('#mes').show(300);
			$('#empleado').show(300);
			$('#incidencia').hide(500);
			$('#responsables').hide(500);
			$('#ubicaciones').hide(500);
		break;
		case '3':
			$('#mes').show(300);
			$('#incidencia').show(300);
			$('#empleado').hide(500);
			$('#responsables').hide(500);
			$('#ubicaciones').hide(500);
		break;
		case '4':
			$('#incidencia').show(300);
			$('#empleado').show(300);
			$('#mes').hide(500);
			$('#responsables').hide(500);
			$('#ubicaciones').hide(500);
		break;
		case '5':
			$('#mes').show(300);
			$('#responsables').show(300);
			$('#incidencia').hide(500);
			$('#empleado').hide(500);
			$('#ubicaciones').hide(500);
		break;
		case '6':
			$('#mes').show(300);
			$('#ubicaciones').show(300);
			$('#incidencia').hide(500);
			$('#responsables').hide(500);
			$('#empleado').hide(500);
		break;
	}
}
function loadGraph() {
	var caso = $('#tipograf').val();
	var id = $('#selEmpleado').val();
	var empresa = $('#idEmp').val();
	var mes, tipoIn, resubic=0, tipoNm=0;
	switch (caso){
		case '1':
			mes = 0; id=0;
			var tipo = $('#selIncidencia').val().split('*3*');
			//alert(tipo[0]);
			tipoIn = tipo[0];
			tipoNm = tipo[1];
		break;
		case '2':
			mes = $('#selectMes').val();
			tipoIn = 0;
		break;
		case '3':
			id = 0;
			var tipo = $('#selIncidencia').val().split('*3*');
			tipoIn = tipo[0];
			tipoNm = tipo[1];
			mes = $('#selectMes').val();
		break;
		case '4':
			mes = 0;
			var tipo = $('#selIncidencia').val().split('*3*');
			tipoIn = tipo[0];
			tipoNm = tipo[1];
		break;
		case '5':
			id = 0; tipoIn=0;
			var resubic = $('#selResponsable').val();
			var mes = $('#selectMes').val();
		break;
		case '6':
			id = 0; tipoIn=0;
			var resubic = $('#selUbicacion').val();
			var mes = $('#selectMes').val()
		break;
	}
	request = $.ajax({
		method: 'post',
		url: 'incidencias/infoGrafica.php',
		data:{
			'bandera': caso,
			'empleado': id,
			'fecha': mes,
			'incidencia': tipoIn,
			'empresa': empresa,
			'respOubic': resubic
		},
		success: function(data) {}
	});
	request.done(function(response, textStatus, jqXHR) {
		var obj = jQuery.parseJSON(response);
		var j=0;
		switch (caso){
			case '1':
				if (obj == 0){
					noData();
				} else {
					console.log(obj);
					google.charts.setOnLoadCallback(drawChart6(obj,tipoNm));
				}
			break;
			case '2':
				for (var i=0; i<obj.length; i++){
					if (obj[i].data == 0){
						j++
					}
				}
				if (j == obj.length) {
					noData();
				} else {
					console.log(obj);
					google.charts.setOnLoadCallback(drawChart1(obj));
				}
			break;
			case '3':
				for (var i=0; i<obj.length; i++){
					if (obj[i].num == 0){
						j++
					}
				}
				if (j == obj.length) {
					noData();
				} else {
					console.log(tipoNm);
					google.charts.setOnLoadCallback(drawChart3(obj,tipoNm));
				}
			break;
			case '4':
				for (var i=0; i<obj.length; i++){
					if (obj[i] == 0){
						j++
					}
				}
				if (j == obj.length) {
					noData();
				} else {
					console.log(obj);
					google.charts.setOnLoadCallback(drawChart2(obj,tipoNm));
				}
			break;
			case '5':
				if (obj == 0) {
					noData();
				} else {
					console.log(obj);
					google.charts.setOnLoadCallback(drawChart4(obj));
				}
			break;
			case '6':
				if (obj == 0) {
					noData();
				} else {
					console.log(obj);
					google.charts.setOnLoadCallback(drawChart5(obj));
				}
			break;
		}
	});
}
function drawChart6(obj){
	// FALTA AGREGAR CORRECTAMENTE COLUMNAS DE LA TABLA
	/*var Max = [];
	$.each(obj,function (i,v){
		Max.push(v.NUM);
	});
	Array.prototype.max = function() {
		return Math.max.apply(null, this);
	};
	alert(Max.max());
	//return;
	*/
	var datos = new google.visualization.DataTable();
	datos.addColumn('date', 'Fecha');
	datos.addColumn('number','Incidencia de '+obj.name);
	datos.addColumn('string','Empleado');
	var k=1;
	
	$.each(obj, function(index,value){
		//var M = Max.max();
		$.each(value.data,function(nInd,nVal){
			var val = nVal[0].split('-');
			datos.addRow([new Date(val[0],val[1]-1,val[2]), nVal[1], value.name]); //array.push(nVal[0],nVal[1],value.name); // fecha, $res
		});
	/*	var x = array.length;
		M=M*2;
		if (x!=M){
			var j=M-x;
			for (var i=1;i<=j;i++){	
				array.push('');
			}
		}
		k++;*/
	});
	var options={ displayAnnotations: true, displayZoomButtons: false };
	var grafica = new google.visualization.AnnotationChart(document.getElementById('grafica'));
	grafica.draw(datos,options);
}
function drawChart1(obj) {
	var datos = new google.visualization.DataTable();
	datos.addColumn('string', 'Incidencia');
	datos.addColumn('number', 'No. de Incidencias');
	datos.addColumn({type:'string', role:'annotation'});
	datos.addColumn({type:'string', role:'style'});
	var j = 0;
	for(j;j<obj.length;j++){
		datos.addRow([obj[j].name, parseInt(obj[j].data), ''+obj[j].data+'', colorRandom()]);
	}
	var options = {
		'title':'Número de incidencias por empleado',
		'width':800,
		'height':500,
		'vAxis': {title: "Incidencias"},
		'hAxis': { title: "No. de Incidencias", format: '#,###', minValue: 0, maxValue: 4 },
		'legend': {	position: 'none'},
		'annotations': {'alwaysOutside': true}
	};
	var grafica = new google.visualization.BarChart(document.getElementById('grafica'));
	grafica.draw(datos, options);
}
function drawChart2(obj,incidencia){
	var datos = new google.visualization.DataTable();
	datos.addColumn('string', 'Mes');
	datos.addColumn('number', 'Incidencias');
	datos.addColumn({type:'string', role:'annotation'});
	datos.addRows([['Enero',obj[0],''+obj[0]+''],['Febrero',obj[1],''+obj[1]+''],['Marzo',obj[2],''+obj[2]+''],['Abril',obj[3],''+obj[3]+''],
			['Mayo',obj[4],''+obj[4]+''],['Junio',obj[5],''+obj[5]+''],['Julio',obj[6],''+obj[6]+''],['Agosto',obj[7],''+obj[7]+''],
			['Septiembre',obj[8],''+obj[8]+''],['Octubre',obj[9],''+obj[9]+''],['Noviembre',obj[10],''+obj[10]+''],['Diciembre',obj[11],''+obj[11]+'']
	]);				
	var options = {
		'title': incidencia+' en el año actual ('+d.getFullYear()+')',
		'width':800,
		'height':500,
		'vAxis': { title: "No. de Incidencias", format: '#,###', minValue: 0, maxValue: 4},
		'hAxis': { title: "Mes" },
		'annotations': {'alwaysOutside': true}
	};
	var grafica = new google.visualization.LineChart(document.getElementById('grafica'));
	grafica.draw(datos, options);
}
function drawChart3(obj,incidencia){
	var datos = new google.visualization.DataTable();
	datos.addColumn('string', 'Empleado');
	datos.addColumn('number', 'No. de Incidencias');
	datos.addColumn({type:'string', role:'annotation'});
	datos.addColumn({type:'string', role:'style'});
	var j = 0;
	for(j;j<obj.length;j++){
		datos.addRow([ obj[j].name, parseInt(obj[j].num), ''+obj[j].num+'', colorRandom() ]);
	}
	var options = {
		'title': incidencia+' - '+obj[0].date,
		'width':800,
		'height':500,
		'legend': {	position: 'none'},
		'annotations': { 'alwaysOutside': true },
		'vAxis': { title: "Empleado " },
		'hAxis': { title: "No. de Incidencias", format: '#,###', minValue: 0, maxValue: j-1 }
	}
	var grafica = new google.visualization.BarChart(document.getElementById('grafica'));
	grafica.draw(datos, options);
}
function drawChart4(obj) {
	var datos = new google.visualization.DataTable();
	datos.addColumn('string', 'Empleado');
	var j = 0;	
	for(j; j<obj[1][0].length; j++){
		datos.addColumn('number', String(obj[1][0][j].incidencia));
		datos.addColumn({type:'string', role:'annotation'});
	}
	j = 0;
	var x = new Array();
	for(j; j<obj.length; j++){
		var emp=0;
		if (j%2 == 0){
			var x=new Array();
			emp = obj[j].name;
			x.push(String(emp));
		} else {
			for (var i=0; i<obj[j][0].length; i++){
				x.push(parseInt(obj[j][0][i].num));
				x.push(String(obj[j][0][i].num));
			}
		}
		if (j%2 != 0){
			console.log(x);
			datos.addRow(x);
		}
	}
	var options = {
		'title':'Número de incidencias por empleado',
		'height':500,
		'vAxis': { title: "No. de Incidencias", 'format': '#,###', minValue: 0, maxValue: 4 },
		'hAxis': { title: "Empleados" },
		'legend': {	position: 'none'},
		'seriesType': 'bars',
		'series': obj[1][0].length,
		'seriesType': 'bars',
		'annotations': { 'alwaysOutside': true }
	};
	var grafica = new google.visualization.ComboChart(document.getElementById('grafica'));
	grafica.draw(datos, options);
}
function drawChart5(obj) {
	var datos = new google.visualization.DataTable();
	datos.addColumn('string', 'Empleado');
	var j = 0;	
	for(j; j<obj[1][0].length; j++){
		datos.addColumn('number', String(obj[1][0][j].incidencia));
		datos.addColumn({type:'string', role:'annotation'});
	}
	j = 0;
	var x = new Array();
	for(j; j<obj.length; j++){
		var emp=0;
		if (j%2 == 0){
			var x=new Array();
			emp = obj[j].name;
			x.push(String(emp));
		} else {
			for (var i=0; i<obj[j][0].length; i++){
				x.push(parseInt(obj[j][0][i].num));
				x.push(String(obj[j][0][i].num));
			}
		}
		if (j%2 != 0){
			console.log(x);
			datos.addRow(x);
		}
	}
	var options = {
		'title':'Número de incidencias por empleado',
		'height':500,
		'vAxis': {
			title: "No. de Incidencias",
			format: '#,###',
			minValue: 0,
			maxValue: 4},
		'hAxis': {title: "Empleados"},
		'legend': {	position: 'none'},
		'seriesType': 'bars',
		'series': obj[1][0].length,
		'seriesType': 'bars',
		'annotations': {'alwaysOutside': true}
	};
	var grafica = new google.visualization.ComboChart(document.getElementById('grafica'));
	grafica.draw(datos, options);
}
function colorRandom() {
	var color = '#', hexa = '0123456789ABCDEF'.split('');
	for (var i=0; i<6; i++) {
		color += hexa[Math.floor(Math.random() * 16)];
	}
	return color;
}