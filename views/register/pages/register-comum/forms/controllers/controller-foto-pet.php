<?php
require_once("/xampp/htdocs/projeto-Petiti/classes/Pet.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/FotoPet.php");

// Objetos

$cookie = new Cookies();
$fotoPet = new FotoPet();
$caminho = "/xampp/htdocs/projeto-petiti/private-user/fotos-pet/";
$caminhoBanco = "";
$foto = $_FILES['flFotoPet'];
$nomeFoto = $foto['name'];


$tipo = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));


if ($foto['size'] == 0) {
    $pet->setIdPet($_COOKIE['retorno-id']);
    $fotoPet->setPet($pet);
    $fotoPet->setNomeFotoPet("padrao.png");
    $fotoPet->setCaminhoFotoPet("private-user/fotos-pet/padrao.png");
    $fotoPet->cadastrar($fotoPet);
} elseif ($foto['error'] <> 0) {
    $cookie->criarCookie("erro-foto", "Erro ao subir imagem, tente novamente.", 1);
    header('location: ../formulario-foto-pet.php');
} elseif (($tipo <> 'jpg') && ($tipo <> 'jpeg') && ($tipo <> 'png')) {
    $cookie->criarCookie("erro-foto", "Formato inválido.", 1);
    header('location: ../formulario-foto-pet.php');
} else {
    $nomeRandom = uniqid();
    $caminhoCompleto = $caminho . $nomeRandom . "." . $tipo;
    move_uploaded_file($foto['tmp_name'], $caminhoCompleto);


    $caminhoBanco = "private-user/fotos-pet/" . $nomeRandom . "." . $tipo;
    $nomeTipo = $nomeRandom . "." . $tipo;
    $Pet->setIdPet($_COOKIE['retorno-id']);
    $fotoPet->setPet($pet);
    $fotoPet->setNomeFotoPet($nomeTipo);
    $fotoPet->setCaminhoFotoPet($caminhoBanco);
    $fotoPet->cadastrar($fotoPet);
    header('location: controller-teste.php');
}
