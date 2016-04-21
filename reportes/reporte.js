function filtrar_incidencias(empresa,ubicacion,responsable,puesto,tipoIn,fechai,fechaf){
	//console.log(arguments);
	var emmpresa = empresa|| "";
	var ubicacion = ubicacion|| "";
	var responsable = responsable || "";
	var puesto = puesto || "";
	var tipoIn = tipoIn || "";
	var fechai = fechai || "";
	var fechaf = fechaf || "";

	$.ajax({
        url: 'reportes/controlador_reporte.php',
        type: "POST",
        data: {
        	empresa: empresa,
        	ubicacion: ubicacion,
        	responsable: responsable,
        	puesto: puesto,
        	tipoIn: tipoIn,
        	fechai: fechai,
        	fechaf: fechaf,
        	a:'filtrar'
        },
        async: true,
        success: function (msg) {
        	$(".listado").dataTable().fnDestroy();
            $("#tabla").empty().append(msg);
            $(".listado").dataTable({
                "dom": '<lf>rt<ip>',
                stateSave: true,
                aLengthMenu: [
                    [25, 10, 50, 100, -1],
                    [25, 10, 50, 100, "Todo"]
                ],
                "bSort": true,
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
                "pagingType": "full_numbers"
            });
        }
    });
}