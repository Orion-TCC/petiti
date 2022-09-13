<?php
require_once("/xampp/htdocs/petiti/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/classes/FotoUsuario.php");
require_once("/xampp/htdocs/petiti/classes/Cookies.php");
// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();

$caminho = "/xampp/htdocs/projeto-petiti/private-user/fotos-perfil/";
$caminhoBanco = "";
$foto = $_FILES['flFoto'];
$nomeFoto = $foto['name'];


$tipo = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));

@session_start();
if ($foto['size'] == 0) {
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto("padrao.png");
    $fotoUsuario->setCaminhoFoto("private-user/fotos-perfil/padrao.png");
    $fotoUsuario->cadastrar($fotoUsuario);
    header('location: ../finalizar-cadastro-empresa.php');
} elseif ($foto['error'] <> 0) {
    $cookie->criarCookie("erro-foto", "Erro ao subir imagem, tente novamente.", 1);
    header('location: ../formulario-foto-empresa.php');
} elseif (($tipo <> 'jpg') && ($tipo <> 'jpeg') && ($tipo <> 'png')) {
    $cookie->criarCookie("erro-foto", "Formato inválido.", 1);
    header('location: ../formulario-foto-empresa.php');
} else {
    $nomeRandom = uniqid();
    $caminhoCompleto = $caminho . $nomeRandom . "." . $tipo;
    move_uploaded_file($foto['tmp_name'], $caminhoCompleto);


    $caminhoBanco = "private-user/fotos-perfil/" . $nomeRandom . "." . $tipo;
    $nomeTipo = $nomeRandom . "." . $tipo;
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto($nomeTipo);
    $fotoUsuario->setCaminhoFoto($caminhoBanco);
    $fotoUsuario->cadastrar($fotoUsuario);
    header('location: ../formulario-ramo.php');
}
