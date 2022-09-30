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
@session_start();
$id = $usuario->procuraId2($login_email = $_POST['txtLoginEmail']);
if ($msg == "Bem vindo.") {
   
    $url = "http://localhost/petiti/api/usuario/$id";

    $json = file_get_contents($url);
    $dados = json_decode($json);
    $login = $dados[0]->loginUsuario;

    $_SESSION['login'] = $login;
    header('location: /petiti/feed');
} else {
    header('location: /petiti/login');
    $cookie->criarCookie('retorno-login', $msg, 2);
}
