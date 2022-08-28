<?php
require_once("/xampp/htdocs/projeto-Petiti/classes/Usuario.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/FotoUsuario.php");
require_once("/xampp/htdocs/projeto-Petiti/classes/Cookies.php");
// Objetos
$usuario = new Usuario();
$fotoUsuario = new FotoUsuario();
$cookie = new Cookies();

<<<<<<< HEAD
$usuario->login("penis", "123");
=======
$usuario->login("test1", "123");
>>>>>>> bbe7c830ed232a6a0319b6216d8d74b54bc459b9
// $fotoUsuario->setIdFotoUsuario(15);
// print_r($fotoUsuario->delete($fotoUsuario));
@session_start();

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>
<<<<<<< HEAD
<img width="300px" src="../../../../../../<?php echo $_SESSION['foto'] ?>" alt="">
=======
<img width="300px" src="../../../../../../<?php echo $_SESSION['foto'] ?>" alt="">
>>>>>>> bbe7c830ed232a6a0319b6216d8d74b54bc459b9
