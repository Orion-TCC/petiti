<?php
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
$cookie = new Cookies();
$image = $_POST['image'];
$imagem2 = @$_FILE['flFoto'];

require_once("/xampp/htdocs/petiti/api/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/api/classes/FotoUsuario.php");
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();

$caminho = "/xampp/htdocs/petiti/private-user/fotos-perfil/";
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
    header('location: /petiti/inicio-pet');
} elseif ($foto['error'] <> 0) {
    $cookie->criarCookie("erro-foto", "Erro ao subir imagem, tente novamente.", 1);
    header('location: /petiti/foto-usuario');
} elseif (($tipo <> 'jpg') && ($tipo <> 'jpeg') && ($tipo <> 'png')) {
    $cookie->criarCookie("erro-foto", "Formato inválido.", 1);
    header('location: /petiti/foto-usuario');
} else {
    list($type, $image) = explode(';', $image);
    list(, $image) = explode(',', $image);
    $image = base64_decode($image);
    $image_name = time() . uniqid() . '.png';
    $caminhoBanco = "private-user/fotos-perfil/".$image_name;
    file_put_contents("../../../private-user/fotos-perfil/" . $image_name, $image);
    echo $image_name;
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto($image_name);
    $fotoUsuario->setCaminhoFoto($caminhoBanco);
    $fotoUsuario->cadastrar($fotoUsuario);
    echo 'successfully uploaded';
}
