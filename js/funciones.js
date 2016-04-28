/* Funciones JS */

// Link
function goto(archivo,carpeta){
    if(archivo!=null) {
		if(carpeta!=null) {
			window.location = 'view.php?com='+carpeta+'&mod='+archivo;
		} else {
			window.location = 'view.php?mod='+archivo;
		}
	}else{
		window.location = 'view.php';
	}
}

// Mostrar Fecha y Hora
function mostrarHora() {
	if (!document.layers&&!document.all&&!document.getElementById)
	return
	var Digital=new Date()
	var hours=Digital.getHours()
	var minutes=Digital.getMinutes()
	var seconds=Digital.getSeconds()
	var dn="AM"
	var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	var Mes = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var Hoy = new Date();
	var Anio = Hoy.getFullYear();
	var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " " + Anio;
	 if (hours>12){
		dn="PM"
		hours=hours-12
	 }
	 if (hours==0)
		hours=12
	 if (minutes<=9)
		minutes="0"+minutes
	 if (seconds<=9)
		seconds="0"+seconds
	myclock=hours+":"+minutes+" "+dn
	if (document.layers){
		document.layers.liveclock.document.write(myclock)
		document.layers.liveclock.document.close()
	}
	else if (document.all) {
		liveclock.innerHTML=myclock
	}
	else if (document.getElementById) {
		var idHora = "horaActual";
		var idFecha = "fechaActual";
		if($('#'+idHora).length) {
			document.getElementById(idHora).innerHTML=myclock
		}
		if($('#'+idFecha).length) {
			document.getElementById(idFecha).innerHTML=Fecha
		}
	}
	setTimeout("mostrarHora()",1000)
}

function convertirFecha(fecha,div) {
	var elem = fecha.split("-");
	var anio = elem[0];
	var mes = elem[1];
	var dia = elem[2];
	var mesFormat = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$(div).html(dia+' '+mesFormat[parseInt(mes)-1]+' '+anio);
}

/**
 * [send_ajax_form description]
 * @param  {[type]} str    [description]
 * @param  {[type]} params [description]
 * @param  {[type]} a    [accion que efectua la funcion]
 * @return {[data]}        [sin uso]
 */
function send_ajax_form(str, params){
    $.ajax({
        url: str,
        type: "POST",
        data: params,
        success: function(data){
        	/*if(a=1){
        		alertify.success(msg);
        	}else if(a=2){
        		alertify.success("Operacion realizada correctamente");
        		setTimeout (window.location = data;, 5000);
        	}*/
        	console.log(data);
        }
    });
}
function paginate(id) {
	$('table'+id).each(function(i,e) {
		if(!$(this).hasClass("destroy")) {
			var pag = ($(this).hasClass("nopagination") ? false : true);
			var order = ($(this).hasClass("no-order") ? false : true);
			$("table"+id).dataTable({
				"dom": '<lf>rt<ip>',
				"language": {
					"emptyTable": "No hay datos disponibles en la tabla.",
					"info": "Se muestran de _START_ a _END_ de _TOTAL_",
					"infoEmpty": "Se muestran de 0 a 0 de 0",
					"infoFiltered": "(filtrado de _MAX_ totales)",
					"infoPostFix": "",
					"thousands": ",",
					"lengthMenu": "Mostrar _MENU_",
					"loadingRecords": "Cargando...",
					"processing": "Procesando...",
					"search": "Buscar:",
					"zeroRecords": "No se encontraron resultados.",
					"paginate": {
						"first": "Primera",
						"last": "Última",
						"next": "Sig.",
						"previous": "Ant."
					},
					"aria": {
						"sortAscending":  ": activar para ordenar ascendente",
						"sortDescending": ": activar para ordenar descendente"
					}
				},
				"ordering": order,
				"bPaginate": pag,
				"pagingType": "full_numbers",
				aLengthMenu: [
			        [10, 25, 50, 100, -1],
			        [10, 25, 50, 100, "Todo"]
			    ],
			    //iDisplayLength: -1,
				columnDefs: [{
					targets: 'no-sort',
					orderable: false
				}]
			});
		}
    });
}
