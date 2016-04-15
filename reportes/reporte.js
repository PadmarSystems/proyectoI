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
            $("#tabla").empty().append(msg);
        }
    });
}