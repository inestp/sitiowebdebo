<?php

// DEJAR COMO ESTA //////////
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//////////////////////////////////////


/*ACA ESTAN LOS VALORES QUE VIENEN DESDE EL FORMULARIO HTML EN ESTE CASO ESTAMOS SUPONIENDO QUE HAY TRES INPUTS QUE EN SU CORRESPONDIENTE ATRIBUTO NAME TIENEN LOS NOMBRES: nombre, email, telefono,mensaje
nombre, email , telefono,mensaje 
*/

$nombre = addslashes($_POST['nombre']);
$email = addslashes($_POST['email']);
$telefono = addslashes($_POST['telefono']);
$mensaje = addslashes($_POST['mensaje']);

/////////////////////////////////////////

$mail = new PHPMailer; // DEJAR COMO ESTA
$mail->isSMTP();// DEJAR COMO ESTA

/*IMPORTANTE !! LOS DATOS QUE ESTAN A CONTINUACIÓN LOS DEBEN AVERRIGUAR EN SU PROVEEDOR DE HOSTING */

$mail->Host = 'sd-1539852-l.dattaweb.com'; // ESTE ES EL SERVIDOR DE SMTP. EN GENERAL ES smtp.dominio.com.ar. PREGUNTAR A LA EMPRESA DE HOSTING

$mail->Port = 25; // DEJAR COMO ESTA

$mail->SMTPAuth = true; // DEJAR COMO ESTA

////////////////////////////////////////////////////////

/* PARA QUE FUNCIONE ESTE METODO DE MANDAR MAIL, PRIMERO HAY QUE ENTRAR AL CPANEL Y CREAR UNA CUENTA DE MAIL ESPECIAL QUE SERVIRA PARA MANDAR LOS MAILS. POR EJEMPLO: CONTACTO@DOMINO.COM.AR */

$mail->Username = 'contacto@psideborahfelice.com.ar'; // ES EL MAIL QUE SACARON
$mail->Password = 'QKa*Z086yV'; // CONTRASEÑA DEL MAIL

$mail->setFrom('contacto@psideborahfelice.com.ar', 'Nombre web'); // DEBE TENER EL MAIL PREVIAMENTE CONFIGURADO Y UN NOMBRE QUE ES EL QUE APARECE EN EL FROM

$mail->addAddress('inestp1@gmail.com', 'Nombre web'); // A QUIEN VA DIRIGIDO EL MAIL. COMO ES PARA NOSOTROS SE PUEDE PONER EL MISMO MAIL QUE SACAMOS U OTRO.

//Set the subject line
$mail->Subject = 'Contacto desde sitio Web'; // ES EL ASUNTO CON EL QUE VAMOS A RECIBIR EL MAIL

//////////////////////////////////////////////////////////////////

/*
ARMAMOS EL CONTENIDO DEL MAIL EN HTML. TENER EN CUENTA QUE TIENEN QUE PONER CON #NOMBREINPUT.
POR EJEMPLO SI AGREGAMOS OTRO INPUT EN EL FORMULARIO QUE TENGA COMO name='apellido' HABRIA QUE AGREGAR OTRA LINEA:
<p> <strong>Mensaje:</strong> #apellido</p>.
SE PUEDE ARMAR EL HTML QUE QUIERAN, PERO SIEMPRE PONIENDO LOS VALORES DEL NAME DE LOS INPUTS.

*/
$contenido = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>PHPMailer Test</title>
</head>
<body>
<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
  <h1>Contacto desde la Web</h1>
  <p> <strong>Nombre:</strong> #nombre</p>
  <p> <strong>Mail:</strong> #email</p>
  <p> <strong>Tel:</strong> #telefono</p>
  <p> <strong>Mensaje:</strong> #mensaje</p>
</div>
</body>
</html>';
////////////////////////////////////////////////////

$valores = array("#nombre", "#email", "#telefono","#mensaje"); /*TIENEN QUE ESTAR TODOS LOS NAMES DE LOS INPUTS. SI EN EL FORMULARIO AGREGAMOS EL CAMPO APELLIDO DEBERIA QUEDAR: $contenidovalores = array($nombre,$email,$telefono,$mensaje,$apellido);*/
$contenidovalores = array($nombre,$email,$telefono,$mensaje);
$contenido = str_replace($valores, $contenidovalores, $contenido);

$mail->Body = $contenido; // DEJAR IGUAL

$mail->AltBody = 'Nombre:$nombre - Mail:$email - Mensaje: $mensaje'; // ESTO APARECERA EN EL CUERPO DEL MAIL EN EL CASO DE QUE EL CLIENTE DE CORREO NO ACEPTE HTML. ES EL CONTENIDO ALTERNATIVO


// SE MANDA EL MAIL
if (!$mail->send()) {
    // SI SALE TODO BIEN
    header('Location: contacto-error.html');
} else {
    // SI HAY ALGUN ERROR
    header('Location: contacto-ok.html');
}



?>