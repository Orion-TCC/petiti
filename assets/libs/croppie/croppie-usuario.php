<?php
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
@session_start();
require_once("/xampp/htdocs/petiti/api/classes/Usuario.php");
require_once("/xampp/htdocs/petiti/api/classes/FotoUsuario.php");
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");

// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();
$image = $_POST['imageBase'];
if ($image == "") {
    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto("padrao.png");
    $fotoUsuario->setCaminhoFoto("private-user/fotos-perfil/padrao.png");
    $fotoUsuario->cadastrar($fotoUsuario);
} else {
    $caminhoSalvar = "/xampp/htdocs/petiti/private-user/fotos-perfil/";


    $nomeArquivo = time() . ".png";
    $arquivoCompleto = $caminhoSalvar . $nomeArquivo;

    $usuario->setIdUsuario($_SESSION['id-cadastro']);
    $fotoUsuario->setUsuario($usuario);
    $fotoUsuario->setNomeFoto($nomeArquivo);

    $caminhoBanco = "private-user/fotos-perfil/" . $nomeArquivo;

    $fotoUsuario->setCaminhoFoto($caminhoBanco);
    $fotoUsuario->cadastrar($fotoUsuario);


    file_put_contents($arquivoCompleto, file_get_contents($image));
    echo $arquivoCompleto;
}
