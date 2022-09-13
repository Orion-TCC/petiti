<?php
require_once("/xampp/htdocs/petiti/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/classes/TipoUsuario.php");
require_once("/xampp/htdocs/petiti/classes/Cookies.php");


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
    header('location: ../formulario-usuario.php');
} elseif ($senha <> $senhaConfirmacao) {
    $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
    header('location: ../formulario-usuario.php');
} else {
    $usuario->setNomeUsuario($_POST['txtNomeUsuario']);
    $usuario->setLoginUsuario($_POST['txtLoginUsuario']);
    $usuario->setEmailUsuario($_POST['txtEmailUsuario']);
    $usuario->setSenhaUsuario($_POST['txtPw']);
    $usuario->setVerificadoUsuario(0);
    $tipoUsuario->setIdTipoUsuario(1);
    $usuario->setTipoUsuario($tipoUsuario);


    // Cadastro
    $retorno = $usuario->cadastrar($usuario);
    $msg = $retorno["msg"];
    if ($msg == "Cadastro realizado com sucesso") {
        $id = $retorno["id"];
        @session_start();
        $_SESSION['id-cadastro'] = $id;

        header('location: ../formulario-foto.php');
    } else {
        $cookie->criarCookie("erro-cadastro", $msg, 1);
        header('location: ../formulario-usuario.php');
    }
}
