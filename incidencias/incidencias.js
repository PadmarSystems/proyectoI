function post_form(){
	var formulario = $("#formIncidencia").serialize();
	console.log(formulario);
	$.ajax({
        url: 'incidencias/controlador_incidencias.php',
        type: "GET",
        data: formulario+"&a=crear",
        success: function(data){
        	console.log(data);
        }
	});
}