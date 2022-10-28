<?php
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
$cookie = new Cookies();
$image = $_POST['image'];
$cookie->criarCookie("imagem-cortada", $image, 10000);

echo 'successfully uploaded';