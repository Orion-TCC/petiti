<?php
require_once("/xampp/htdocs/projeto-Petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/FotoUsuario.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/Cookies.php");
// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();

$usuario->login("liandro", "123");

@session_start();

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>
<img width="300px" src=<?php echo $_SESSION['foto'] ?> alt="">
