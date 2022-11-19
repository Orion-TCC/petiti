<?php 
@session_start();
require_once('/xampp/htdocs/petiti/api/classes/Usuario.php');
if (!isset($_SESSION['login'])) {
    header("Location: /petiti/login");
}else{
    $usuario = new Usuario();
    $usuario->login($_SESSION['login'], $_SESSION['senha']);
    echo "<script>console.log('logado');</script>";
}
