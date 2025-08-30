<?php ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = 2; // Muestra la depuración SMTP 
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'contacto@compulg.com.co';
$mail->Password = 'Nde-13d9446Xsq-02a'; // Coloca tu contraseña real aquí 
$mail->setFrom('contacto@compulg.com.co', 'CompuLG');
$mail->addReplyTo('contacto@compulg.com.co', 'CompuLG');
$mail->addAddress('luisga158@gmail.com', 'Luis Gabriel');
$mail->Subject = 'Checking if PHPMailer works';
$mail->Body = 'This is just a plain text message body';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
?>

