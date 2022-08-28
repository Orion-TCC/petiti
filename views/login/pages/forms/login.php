<form action="verificaLogin.php" method="POST">
    <input type="text" name="txtLoginEmail" placeholder="Login ou Email">
    <input type="text" name="pw" placeholder="Senha">
    <input type="submit" value="Entrar">
</form>
<?php echo @$_COOKIE['retorno-login'] ?>