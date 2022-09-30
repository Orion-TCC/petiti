<?php
// Classes
require_once("/xampp/htdocs/petiti/api/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");


// Objetos
$usuario = new Usuario();
$cookie = new Cookies();


$login_email = $_POST['txtLoginEmail'];
$senha = $_POST['pw'];

$msg = $usuario->login($login_email, $senha);

echo $msg;
if ($msg == "Bem vindo.") {
    header('location: ../../feed');
    $cookie->criarCookie('retorno-login', $msg, 2);
} else {
    header('location: /petiti/login/');
    $cookie->criarCookie('retorno-login', $msg, 2);
}
