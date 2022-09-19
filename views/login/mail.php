<?php 
@session_start();

$receiver = $_SESSION['emailRecuperacao'];
$subject = "Email de recuperação";
$body = "Sua nova senha temporária: ".uniqid();
$sender = "orion.etec@gmail.com";

if (mail($receiver, $subject, $body, $sender)) {
    echo "foi pro".$_SESSION['emailRecuperacao'];
    unset($_SESSION['emailRecuperacao']);
}else {
    echo "nao foi";
}