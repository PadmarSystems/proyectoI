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

function mostrardetalle(a,id){
  $.ajax({
    url: "incidencias/controlador_incidencias.php",
    type: "POST",
    data: {a: a, idEmpleado:id},
    success: function(data){
      //$( "#dialog-message" ).empty().append(data);
      $( "#dialog-message" ).empty().append(data).dialog({
        modal: true,
        title: a,
        buttons: {
          Ok: function() {
            $( this ).dialog( "close" );
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
      $("#a-campos").empty().append(data);
    }
  });
}

