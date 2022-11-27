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
    header('location: /petiti/views/recover/senha-recuperacao.php?emailenviado=true');
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        $mail->CharSet = 'UTF-8';
        $mail->Priority = 1; // High priority flag is set.  
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'orion.etec@gmail.com';
        $mail->Password   = 'orionEtec';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('orion.etec@gmail.com', 'Orion');
        $mail->addAddress($_POST['txtEmail'], 'Usuario(a)');
        $mail->addAddress($_POST['txtEmail'], 'Usuario(a)');
        $mail->addReplyTo('noreply@orion.com', 'Não responda.');
        $mail->addCC($_POST['txtEmail'], 'Usuario(a)');
        $mail->addBCC($_POST['txtEmail'], 'Usuario(a)');
        $mail->isHTML(true);
        $mail->AddEmbeddedImage('../assets/images/logo_principal.png', 'logo');
        $mail->Subject = "Recuperação de senha | pet iti";
        $mail->Body =
        "
            <div style='font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif;background-color: #BAD5DB;display: flex; align-items: center; justify-content: center; padding: 30px;border-radius: 25px;flex-direction: column;'>
                <div style='background-color: white; padding: 20px;border-radius: 15px;display: flex;align-items: center;flex-direction: column;'>
                    <img style='width: 180px;' src=\"cid:logo\" >
                    <p style='font-weight: 700; '>Você poderá recriar a sua senha no link:</p>
                    <p style='color:#9998D3;font-weight: 500;'>http://localhost/petiti/api/recuperar/senha/".$login."</p>
                </div>
            </div>
            ";
        $mail->AltBody = '';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('location: /petiti/views/recover/senha-recuperacao.php?emailenviado=false');
}
