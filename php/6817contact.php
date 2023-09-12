<?php
$response   = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;
$privatekey = "6LeSddMUAAAAAGJrerTCIWHaYf2act-YP-HkBjxX";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    'secret' => $privatekey,
    'response' => $response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
));

$resp = json_decode(curl_exec($ch));
curl_close($ch);

if ($resp->success) {
	if(isset($_POST['email'])) {

	// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
	$email_to = "rando.nicolas@gmail.com";
	//$email_to = "jaime@jkd.es";
	$email_subject = "Contacto desde la WEB";
	
	// Aquí se deberían validar los datos ingresados por el usuario
	if(!isset($_POST['nombre']) ||
	!isset($_POST['email']) ||
	!isset($_POST['movil']) ||
	!isset($_POST['mensaje2']) ||
	!isset($_POST['mensaje1'])) {

	echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
	echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
	die();
	}

	$email_message = "Detalles del formulario de contacto:\n\n" . $eol;;
	$email_message .= "Nombre: " . $_POST['nombre'] . "\n" . $eol;;
	$email_message .= "Móvil: " . $_POST['movil'] . "\n" . $eol;;
	$email_message .= "E-mail: " . $_POST['email'] . "\n" . $eol;;
	$email_message .= "Asunto: " . $_POST['mensaje1'] . "\n\n" . $eol;;
	$email_message .= "Texto: " . $_POST['mensaje2'] . "\n\n" . $eol;;


	// Ahora se envía el e-mail usando la función mail() de PHP
	$headers = "De: $nombre <$email_from>\r\n";
	$headers .= "Reply-To: $nombre <$email_from>\r\n";
	$headers .= "X-Mailer:PHP/".phpversion()."\n";
	$headers .= "Mime-Version: 1.0\n";
	//$headers .= "Content-Type: text/html; charset = UTF-8 \n";  
	//
	//mail($para, utf8_decode($asunto), utf8_decode($mensaje), $header);
	if (mail($email_to, utf8_decode($email_subject), utf8_decode($email_message), $headers))
	{
		echo "<center><br /><br /><img src='../images/logo.png'></img><br /><br />FORMULARIO ENVIADO CORRECTAMENTE. EN BREVE ME PONDRÉ EN CONTACTO CON USTED.<br /> <br /><a href='../index.html'>VOLVER</a>";
	}
	else
	{
		echo("Error en el envío del correo.");
	}
	}
} else {
	echo "El Captcha es incorrecto, actualice la página pulsando F5";
    //failed return mess
}
?>

