<?php @session_start(); ?>
<form action="/petiti/api/update" method="post">
    <input type="text" value="<?php echo $_SESSION['tipo'] ?>" disabled>
    <input value="<?php echo $_SESSION['nome'] ?>" type="text" name="txtUpNome" id="txtUpNome">
    <input value="<?php echo $_SESSION['login'] ?>" type="text" name="txtUpUser" id="txtUpUser">
    <input value="<?php echo $_SESSION['email'] ?>" type="text" name="txtUpUser" id="txtUpUser">


</form>