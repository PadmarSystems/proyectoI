function sugiere_usuario(myString){
	var arr = myString.split('@');
	return arr[0];
}
function validUsr(){
	if ($('#correo').val() == null || $('#correo').val().length <= 3){
		alert('Verifique el correo electrónico.');
		$('#correo').focus();
		return false;
	}
	if ( $('#usuario').val().length <= 0 || $('#usuario').val().length > 20 ){
		alert('El nombre de usuario no es válido.');
		$('#usuario').focus();
		return false;
	}
	if ( $("input[name='pass']").val().length <=2 ){
		alert('Ingrese una contraseña más larga');
		$("input[name='pass']").focus();
		return false;
	}
	return true;
}