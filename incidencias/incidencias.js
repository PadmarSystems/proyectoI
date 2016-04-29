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
					Ok: function() {
						$(this).dialog('destroy');
					}
				}
			});
		}
	});
}
