<?php
$image = $_POST['image'];
list($type, $image) = explode(';',$image);
list(, $image) = explode(',',$image);
$image = base64_decode($image);
$image_name = uniqid() . '.png';
file_put_contents("../../../private-user/fotos-publicacao/" . $image_name, $image);
echo 'successfully uploaded';