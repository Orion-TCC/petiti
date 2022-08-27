<form action="controllers/controller-foto.php" method="post" enctype="multipart/form-data">
    <input type="file" name="flFoto" id="flFoto">
    <input type="submit" value="Continuar">
</form>
<?php

echo @$_COOKIE['retorno-id'];
echo @$_COOKIE['erro-foto'];
