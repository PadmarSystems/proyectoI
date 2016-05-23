/* se deben introducir dos caracteres como mínimo */

function validEmp(){
	if ( $('#nombre').val() == 0 || $('#nombre').val() == null || $('#nombre').val().length <= 1){
		alert('El nombre no es válido.');
		$('#nombre').focus();
		return false;
	} else if ( $('#apellidoPat').val() == 0 || $('#apellidoPat').val() == null || $('#apellidoPat').val().length <= 1){
		alert('Uno de los apellidos no es válido.');
		$('#apellidoPat').focus();
		return false;
	} else if ( $('#apellidoMat').val() == 0 || $('#apellidoMat').val() == null || $('#apellidoMat').val().length <= 1){
		alert('Uno de los apellidos no es válido.');
		$('#apellidoMat').focus();
		return false;
	} else if ($('#correo').val() == null || $('#correo').val().length <= 3){
		alert('Verifique el correo electrónico.');
		$('#correo').focus();
		return false;
	} else if ($('#telefono').val() == 0 || $('#telefono').val() == null){
		alert('Verifique su número de teléfono.');
		$('#telefono').focus();
		return false;
	} else if ($('#tipoNomina').val() == null || $('#tipoNomina').val() == ""){
		alert('Verifique el tipo de nómina.');
		$('#tipoNomina').focus();
		return false;
	} else if ($('#nombreAa').val() == 0 || $('#nombreAa').val() == null || $('#nombreAa').val().length <= 1){
		alert('Verifique la información de contacto de accidente.');
		$('#nombreAa').focus();
		return false;
	} else if ($('#telefonoAa').val() == 0 || $('#telefonoAa').val() == null){
		alert('Verifique la información de contacto de accidente.');
		$('#telefonoAa').focus();
		return false;
	}
	return true;
}

function validPuesto(){
	if ( $('#puesto1').val() == 0 || $('#puesto1').val() == null || $('#puesto1').val().length <= 1){
		alert('El puesto no es válido.');
		$('#puesto1').focus();
		return false;
	}
	if ( $('#puesto2').val().length > 0 ){
		if ( $('#puesto2').val() == 0 || $('#puesto2').val() == null || $('#puesto2').val().length <= 1){
			alert('El puesto no es válido.');
			$('#puesto2').focus();
			return false;
		}
	}
	return true;
}

function validResp(){
	switch( $('input[name=a]').val() ){
		case 'Registrar':
			if ( $('#responsableSel').val() == 0){
				if ( $('#responsableN').val() == 0 || $('#responsableN').val() == null || $('#responsableN').val().length <= 1){
					alert('El nombre del responsable no es válido.');
					$('#responsableN').focus();
					return false;
				}
			}
		break;
		case 'Editar':
			if ( $('#nombreNuevo').val() == 0 || $('#nombreNuevo').val() == null || $('#nombreNuevo').val().length <= 1){
				alert('El nombre del responsable no es válido.');
				$('#nombreNuevo').focus();
				return false;
			}
		break;
		default:
			console.log('default');
	}
	return true;
}

function validAlias(){
	if ( $('#nombreNuevo').val() == 0 || $('#nombreNuevo').val() == null || $('#nombreNuevo').val().length <= 1){
		alert('Elija otro nombre para su empresa.');
		$('#nombreNuevo').focus();
		return false;
	}
	return true;
}

function validUbic(){
	switch( $('input[name=a]').val() ){
		case 'Registrar':
			if ( $('#ubicacion1').val() == 0 || $('#ubicacion1').val() == null || $('#ubicacion1').val().length <= 1){
				alert('El nombre de la ubicación no es válido.');
				$('#ubicacion1').focus();
				return false;
			}
			if ( $('#ubicacion2').val().length > 0 ){
				if ( $('#ubicacion2').val() == 0 || $('#ubicacion2').val() == null || $('#ubicacion2').val().length <= 1){
					alert('El nombre de la ubicación no es válido.');
					$('#ubicacion2').focus();
					return false;
				}
			}
			if ( $('#ubicacion3').val().length > 0 ){
				if ( $('#ubicacion3').val() == 0 || $('#ubicacion3').val() == null || $('#ubicacion3').val().length <= 1){
					alert('El nombre de la ubicación no es válido.');
					$('#ubicacion3').focus();
					return false;
				}
			}
		break;
		case 'Editar':
			console.log("edición");
			if ( $('#nombreNuevo').val() == 0 || $('#nombreNuevo').val() == null || $('#nombreNuevo').val().length <= 1){
				alert('El nombre de la ubicación no es válido.');
				$('#nombreNuevo').focus();
				return false;
			}
		break;
		default:
			console.log('default');
	}
	return true;
}

function validUsr(){
	if ($('#correo').val() == null || $('#correo').val().length <= 3){
		alert('Verifique el correo electrónico.');
		$('#correo').focus();
		return false;
	} else if ( $('#usuario').val().length <= 0 || $('#usuario').val().length > 20 ){
		alert('El nombre de usuario no es válido.');
		$('#usuario').focus();
		return false;
	}
	console.log('OK');
	return false;
}