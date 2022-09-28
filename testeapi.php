<?php

$url = "http://localhost:8080/petiti/api/usuarios";


$json = file_get_contents($url);
$dados = json_decode($json);
$teste = @$dados->nomeUsuario;
print_r($teste);
?>

