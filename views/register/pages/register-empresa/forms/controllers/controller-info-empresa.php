<?php
require_once("/xampp/htdocs/projeto-petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-petiti/classes/UsuarioEndereco.php");
require_once("/xampp/htdocs/projeto-petiti/classes/TipoUsuario.php");

$usuario = new Usuario();
$tipoUsuario = new TipoUsuario();
$lista = $usuario->listarUsuario($_COOKIE['retorno-id']);
foreach ($lista as $linha) {
    $id = $linha['idUsuario'];
    $senha = $linha['senhaUsuario'];
    $login = $linha['loginUsuario'];
    $verificado = $linha['verificadoUsuario'];
    $email = $linha['emailUsuario'];
}
$usuario->setIdUsuario($id);
$usuario->setNomeUsuario($_POST['txtNomeEmpresa']);
$usuario->setSenhaUsuario($senha);
$usuario->setLoginUsuario($login);
$usuario->setVerificadoUsuario($verificado);
$usuario->setEmailUsuario($email);
$tipoUsuario->setIdTipoUsuario(2);
$usuario->setTipoUsuario($tipoUsuario);
echo $usuario->getNomeUsuario();

$usuario->update($usuario);

header('location: ../formulario-foto-empresa.php');