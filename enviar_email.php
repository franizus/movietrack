<?php
if(isset($_POST['email'])) {
 
 s siguientes con tu dirección de correo y asunto
 
    $email_to = "
 eddyferch@hotmail.es";
 
    $email_subject = "Tu Asunto de correo";   
 
    function died($error) {
 
        // si hay algún error, el formulario puede desplegar su mensaje de aviso
 
        echo "Lo sentimos, hay un error en sus datos y el formulario no puede ser enviado. ";
 
        echo "Detalle de los errores.<br /><br />";
        
        echo $error."<br /><br />";
 
        echo "Porfavor corrije los errores e inténtelo de nuevo.<br /><br />";
        die();
    }
 
    // Se valida que los campos del formulairo estén llenos
 

 
        died('Lo sentimos pero parece haber un problema con los datos enviados.');       
 
    }
 //Valor "name" nos sirve para crear las variables que recolectaran la información de cada campo
    
    $Nombre = $_POST['Nombre']; // requerido
 
    $Email_form = $_POST['Email']; // requerido
 
    $Telefono = $_POST['Telefono']; // no requerido 

    $Mensaje = $_POST['Mensaje']; // requerido
 
    $error_message = "Error";

//Verificar que la dirección de correo sea válida 
    
   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$Email_from)) {
 
    $error_message .= 'La dirección de correo proporcionada no es válida.<br />';
 
  }

//Validadacion de cadenas de texto

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$Nombre)) {
 
    $error_message .= 'El formato del nombre no es válido<br />';
 
  }
 
  if(strlen($Mensaje) < 2) {
 
    $error_message .= 'El formato del texto no es válido.<br />';
 
  }
 
  if(strlen($error_message) < 0) {
 
    died($error_message);
 
  }
 
//Plantilla de mensaje

    $email_message = "Contenido del Mensaje.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($Nombre)."\n";
 
    $email_message .= "Email: ".clean_string($Email_from)."\n";
 
    $email_message .= "Teléfono: ".clean_string($Telefono)."\n";
 
    $email_message .= "Mensaje: ".clean_string($Mensaje)."\n";
  
 
//Encabezados
 
$headers = 'From: '.$Email_from."\r\n".
 
'Reply-To: '.$Email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
<!-- Mensaje de Éxito-->
 
Muchas Gracias! Proximamente Estaremos en Contacto.
 
<?php 
}
?>