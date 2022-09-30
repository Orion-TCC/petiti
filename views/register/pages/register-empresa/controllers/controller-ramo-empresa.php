<?php
require_once("/xampp/htdocs/petiti/api/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/api/classes/UsuarioEndereco.php");
require_once("/xampp/htdocs/petiti/api/classes/TipoUsuario.php");
@session_start();
$usuario = new Usuario();
$tipoUsuario = new TipoUsuario();
$lista = $usuario->listarUsuario($_SESSION['id-cadastro']);
foreach ($lista as $linha) {
    $id = $linha['idUsuario'];
    $nome = $linha['nomeUsuario'];
    $senha = $linha['senhaUsuario'];
    $login = $linha['loginUsuario'];
    $verificado = $linha['verificadoUsuario'];
    $email = $linha['emailUsuario'];
}
$usuario->setIdUsuario($id);
$usuario->setNomeUsuario($nome);
$usuario->setSenhaUsuario($senha);
$usuario->setLoginUsuario($login);
$usuario->setVerificadoUsuario($verificado);
$usuario->setEmailUsuario($email);
$tipoUsuario->setIdTipoUsuario($_POST['slRamo']);
$usuario->setTipoUsuario($tipoUsuario);
echo $usuario->getNomeUsuario();

$usuario->update($usuario);

header('location: ../finalizar-cadastro-empresa.php');
