<?php
require_once("/xampp/htdocs/petiti/api/classes/Cookies.php");
$cookie = new Cookies();
$image = $_POST['image'];
$cookie->criarCookie("imagem-cortada", $image, 10000);
/* Iremos usar isso aqui pra quando for concluir o post
list($type, $image) = explode(';',$image);
list(, $image) = explode(',',$image);
$image = base64_decode($image);
$image_name = uniqid() . '.png';
file_put_contents("../../../private-user/fotos-publicacao/" . $image_name, $image);
*/
echo 'successfully uploaded';