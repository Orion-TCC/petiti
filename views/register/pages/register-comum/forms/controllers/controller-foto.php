<?php
require_once("/xampp/htdocs/projeto-Petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/FotoUsuario.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/Cookies.php");
// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();

$caminho = "/xampp/htdocs/projeto-petiti/private-user/fotos-perfil/";
$caminhoBanco = "";
$foto = $_FILES['flFoto'];
$nomeFoto = $foto['name'];


$tipo = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));


if ($foto['size'] == 0) {
    $usuario->setIdUsuario($_COOKIE['retorno-id']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto("padrao.png");
    $fotoUsuario->setCaminhoFoto($caminho."padrao.png");
    $fotoUsuario->cadastrar($fotoUsuario);
}elseif ($foto['error'] <> 0) {
    $cookie->criarCookie("erro-foto", "Erro ao subir imagem, tente novamente.", 1);
    header('location: ../formulario-foto.php');
}elseif(($tipo <> 'jpg') && ($tipo <> 'jpeg') && ($tipo <> 'png')){
    $cookie->criarCookie("erro-foto", "Formato inválido.", 1);
    header('location: ../formulario-foto.php');
}else{
    $nomeRandom = uniqid();
    $caminhoCompleto = $caminho . $nomeRandom . "." . $tipo;
    move_uploaded_file($foto['tmp_name'], $caminhoCompleto);

   
    $caminhoBanco = "private-user/fotos-perfil/".$nomeRandom.".".$tipo;
    $nomeTipo = $nomeRandom.".".$tipo;
    $usuario->setIdUsuario($_COOKIE['retorno-id']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto($nomeTipo);
    $fotoUsuario->setCaminhoFoto($caminhoBanco);
    $fotoUsuario->cadastrar($fotoUsuario);
    header('location: controller-teste.php');
   
}





