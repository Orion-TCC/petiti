<?php
session_start();
echo $_SESSION['nome'];

echo "<br>";

echo $_SESSION['login'];

echo "<br>";

?>

<img src="<?php echo $_SESSION['foto'];?>" alt="">