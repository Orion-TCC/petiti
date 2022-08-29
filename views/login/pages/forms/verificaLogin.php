<?php
// Classes
require_once("/xampp/htdocs/projeto-petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-petiti/classes/Cookies.php");


// Objetos
$usuario = new Usuario();
$cookie = new Cookies();


$login_email = $_POST['txtLoginEmail'];
$senha = $_POST['pw'];

$msg = $usuario->login($login_email, $senha);

echo $msg;
if ($msg == "Bem vindo.") {
    header('location:/projeto-petiti/feed.php');
    $cookie->criarCookie('retorno-login', $msg, 2);
}else {
    header('location: login.php');
    $cookie->criarCookie('retorno-login', $msg, 2);
}