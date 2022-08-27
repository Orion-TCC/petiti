<?php 
require_once("../../../../classes/Usuario.php");
require_once("../../../../classes/TipoUsuario.php");
require_once("../../../../classes/Cookies.php");


// Objetos
$usuario = new Usuario();
$tipoUsuario = new TipoUsuario();
$cookie = new Cookies();


// Verficação 
$email = $_POST['txtEmailUsuario'];
$senha = $_POST['txtPw'];
$senhaConfirmacao = $_POST['txtPwConfirm'];

$validacaoEmail = $usuario->validarEmail($email);
if ($validacaoEmail == false) {
    $cookie->criarCookie("erro-cadastro", "Email Inválido", 1);
    header('location: ../cadastro-usuario.php');
}
if ($senha <> $senhaConfirmacao) {
    $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
    header('location: ../cadastro-usuario.php');
}
