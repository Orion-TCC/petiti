<?php
require_once("/xampp/htdocs/petiti/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/classes/TipoUsuario.php");
require_once("/xampp/htdocs/petiti/classes/Cookies.php");


// Objetos
$usuario = new Usuario();
$tipoUsuario = new TipoUsuario();
$cookie = new Cookies();


// Verficação 
$email = $_POST['txtEmailUsuarioEmpresa'];
$senha = $_POST['txtPw'];
$senhaConfirmacao = $_POST['txtPwConfirm'];

$validacaoEmail = $usuario->validarEmail($email);
if ($validacaoEmail == false) {
    $cookie->criarCookie("erro-cadastro", "Email Inválido", 1);
    header('location: ../formulario-usuario-empresa.php');
} elseif ($senha <> $senhaConfirmacao) {
    $cookie->criarCookie("erro-cadastro", "Senhas não coincindem", 1);
    header('location: ../formulario-usuario-empresa.php');
} else {
    $usuario->setNomeUsuario(" ");
    $usuario->setLoginUsuario($_POST['txtLoginUsuarioEmpresa']);
    $usuario->setEmailUsuario($_POST['txtEmailUsuarioEmpresa']);
    $usuario->setSenhaUsuario($_POST['txtPw']);
    $usuario->setVerificadoUsuario(2);
    $tipoUsuario->setIdTipoUsuario(1);
    $usuario->setTipoUsuario($tipoUsuario);


    // Cadastro
    $retorno = $usuario->cadastrar($usuario);
    $msg = $retorno["msg"];
    if ($msg == "Cadastro realizado com sucesso") {
        $id = $retorno["id"];
        @session_start();
        $_SESSION['id-cadastro'] = $id;
        header('location: ../formulario-info-empresa.php');
    } else {
        $cookie->criarCookie("erro-cadastro", $msg, 1);
        header('location: ../formulario-usuario-empresa.php');
    }
}
