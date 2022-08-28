<?php
require_once("/xampp/htdocs/projeto-petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-petiti/classes/Pet.php");
require_once("/xampp/htdocs/projeto-petiti/classes/Cookies.php");


$usuario = new Usuario();
$pet = new Pet();
$cookie = new Cookies();

@session_start();

$pet->setNomePet($_POST['txtNomePet']);
$pet->setRacaPet($_POST['txtRacaPet']);
$pet->setEspeciePet($_POST['txtEspeciePet']);
$pet->setIdadePet($_POST['txtIdadePet']);
$usuario->setIdUsuario($_SESSION['id']);
$pet->setUsuario($usuario); 

$return = $pet->cadastrar($pet);
$id = $return['id'];

$cookie->criarCookie('retorno-id-pet', $id, 2000);

header('location: ../formulario-foto-pet.php');