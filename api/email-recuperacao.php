<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require("classes/Usuario.php");
$usuario = new Usuario();

if ($usuario->procuraEmail($_POST['txtEmail']) == true) {
    $idUsuario = $usuario->procuraId($_POST['txtEmail']);
    $lista = $usuario->listarUsuario($idUsuario);
    foreach ($lista as $linha) {
        $login = $linha['loginUsuario'];
    }
require 'vendor/autoload.php';

$mail = new PHPMailer(true);



try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'orion.etec@gmail.com';
    $mail->Password   = 'lkmrvehesalnmidm';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('orion.etec@gmail.com', 'Orion');
    $mail->addAddress($_POST['txtEmail'], 'Usuario(a)');
    $mail->addAddress($_POST['txtEmail'], 'Usuario(a)');
    $mail->addReplyTo($_POST['txtEmail'], 'Usuario(a)');
    $mail->addCC($_POST['txtEmail'], 'Usuario(a)');
    $mail->addBCC($_POST['txtEmail'], 'Usuario(a)');

    $mail->isHTML(true);
    $mail->Subject = "Recuperação de senha - PetIti";
    $mail->Body = "Você poderá recriar a sua senha no link: http://localhost/petiti/api/recuperar/senha/".$login;
    $mail->AltBody = '';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}else{
    header('location: /petiti/views/recover/senha-recuperacao.php');
}


