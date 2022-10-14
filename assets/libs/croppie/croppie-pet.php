<?php
require_once("/xampp/htdocs/petiti/api/classes/Pet.php");
require_once("/xampp/htdocs/petiti/api/classes/FotoPet.php");
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
@session_start();
// Objetos

$cookie = new Cookies();
$fotoPet = new FotoPet();
$pet = new Pet();
$image = $_POST['imageBase'];
if ($image == "") {
    $pet->setIdPet($_SESSION['id-cadastro-pet']);
    $fotoPet->setPet($pet);
    $fotoPet->setNomeFotoPet("padrao.png");
    $fotoPet->setCaminhoFotoPet("private-user/fotos-pet/padrao.png");
    $fotoPet->cadastrar($fotoPet);
} else {
    $caminhoSalvar = "/xampp/htdocs/petiti/private-user/fotos-pet/";


    $nomeArquivo = time() . ".png";
    $arquivoCompleto = $caminhoSalvar . $nomeArquivo;
    $caminhoBanco = "private-user/fotos-pet/" . $nomeArquivo;

    $pet->setIdPet($_SESSION['id-cadastro-pet']);
    $fotoPet->setPet($pet);
    $fotoPet->setNomeFotoPet($nomeArquivo);
    $fotoPet->setCaminhoFotoPet($caminhoBanco);
    $fotoPet->cadastrar($fotoPet);

    file_put_contents($arquivoCompleto, file_get_contents($image));
    echo $arquivoCompleto;

}
