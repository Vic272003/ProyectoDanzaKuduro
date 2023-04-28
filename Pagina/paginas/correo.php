<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../clases/phpMailer/Exception.php');
require_once('../clases/phpMailer/PHPMailer.php');
require_once('../clases/phpMailer/SMTP.php');

if (isset($_POST['enviarForm'])) {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = "Nombre: " . $nombre . "\nApellidos: " . $apellidos . "\nTelefono: " . $telefono . "\nEmail: " . $email . "\nAsunto: " . $asunto;
    $destino = "hlcvictormartinez@gmail.com";
    $remitente = "From: " . $email;

    //Create a new PHPMailer instance
    $mail = new PHPMailer();
    //Set PHPMailer to use the sendmail transport
    $mail->isSendmail();
    //Set who the message is to be sent from
    $mail->setFrom('from@example.com', 'First Last');
    //Set an alternative reply-to address
    $mail->addReplyTo('replyto@example.com', 'First Last');
    //Set who the message is to be sent to
    $mail->addAddress('victormaresc@gmail.comz', 'John Doe');
    //Set the subject line
    $mail->Subject = 'PHPMailer sendmail test';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML("<html><body><h1>HOLA</h1></body></html>");
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    //Replace the plain text body with one created manually
    //$mail->AltBody = 'This is a plain-text message body';
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
    /*
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only
        $mail->SMTPSecure = 'tls'; // ssl is depracated
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->setFrom($emailFrom, $emailFromName);
        $mail->addAddress($emailTo, $emailToName);
        $mail->Subject = 'PHPMailer GMail SMTP test';
        $mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = 'HTML messaging not supported';
        // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
*/
    //     $nombre=$_POST['nombre'];
    //     $apellidos=$_POST['apellidos'];
    //     $telefono=$_POST['telefono'];
    //     $email=$_POST['email'];
    //     $asunto=$_POST['asunto'];
    //     $mensaje="Nombre: ".$nombre."\nApellidos: ".$apellidos."\nTelefono: ".$telefono."\nEmail: ".$email."\nAsunto: ".$asunto;
    //     $destino="hlcvictormartinez@gmail.com";
    //     $remitente="From: ".$email;

    //     mail($destino,$asunto,$mensaje,$remitente);

    //     exit();
    //     //echo "<script>window.location='../index.php'</script>";
}
