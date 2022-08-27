<form action="controllers/controller-usuario.php" method="post">
    <input placeholder="Insira seu email"type="email" name="txtEmailUsuario" id="txtEmailUsuario">
    <input placeholder="Insira seu nome ou apelido"type="text" name="txtNomeUsuario" id="txtNomeUsuario">
    <input placeholder="Insira seu username"type=" text" name="txtLoginUsuario" id="txtLoginUsuario">
    <input placeholder="Insira sua melhor senha"type="password" name="txtPw" id="txtPw">
    <input placeholder="Confirme a senha"type="password" name="txtPwConfirm" id="txtPwConfirm">
    <input type="submit" value="Continuar">
    <?php
    echo @$_COOKIE['erro-cadastro'] ?>
</form>