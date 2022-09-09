<?php
require_once("/xampp/htdocs/projeto-petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-petiti/classes/Pet.php");
require_once("/xampp/htdocs/projeto-petiti/classes/Cookies.php");


$usuario = new Usuario();
$pet = new Pet();
$cookie = new Cookies();
$arrayEspecies = array(
    1=>"Cachorro",
    2=>"Gato",
    3=>"Roedor",
    4=>"Ave",
    5=>"Exótico"
);
$idade = $_POST['txtIdadePet'];
$slDiaMesAno = $_POST['slIdade'];
if ($idade > 1) {
    $arrayData = array(
        "d" => "dias",
        "m" => "meses",
        "y" => "anos",
    );
    $idadeCompleta = $idade." ".$arrayData[$slDiaMesAno];
}else {
    $arrayData = array(
        "d" => "dia",
        "m" => "mês",
        "y" => "ano",
    );
    $idadeCompleta = $idade . " " . $arrayData[$slDiaMesAno];
}
@session_start();
if ($_POST['slEspecie'] == 0) {
    $cookie->criarCookie('retorno-erro-especie', "Selecione uma espécie", 1);
    header('location: ../formulario-pet2.php');
}
$especie = $arrayEspecies[$_POST['slEspecie']];

$pet->setNomePet($_POST['txtNomePet']);
$pet->setRacaPet($_POST['txtRacaPet']);
$pet->setEspeciePet($especie);
$pet->setIdadePet($idadeCompleta);
$usuario->setIdUsuario($_SESSION['id-cadastro']);
$pet->setUsuario($usuario); 

$return = $pet->cadastrar($pet);
$id = $return['id'];
$_SESSION['id-cadastro-pet'] = $id;


header('location: ../formulario-foto-pet.php');