<?php
require_once("/xampp/htdocs/petiti/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/classes/Cookies.php");


// Objetos
$usuario = new Usuario();
$cookie = new Cookies();


$email = $_POST['emailRecuperacao'];


$boolean = $usuario->procuraEmail($email);
if ($boolean == 1) {
    @session_start();
    $_SESSION['emailRecuperacao'] = $email;
    header('location: mail.php');
}else {
    header('location: login.php');
    $msg = "Email inexistente.";
    $cookie->criarCookie('retorno-login', $msg, 2);
}
?>