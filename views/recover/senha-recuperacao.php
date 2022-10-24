<!DOCTYPE php>
<html lang="en">
<?php
$status = @$_GET['emailenviado'];
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css" />
</head>

<body>
    <nav id="navRecover">
        <div>
            <a href="#">
                <img class="logoNavbar" src="/petiti/assets/images/logo_principal.svg" /></a>
        </div>
        <div class="textoNavRecover">Recuperação de senha</div>
    </nav>
    <?php if (isset($_GET['emailenviado'])) { ?>

        <?php
        if ($status == "true") { ?>
            <div class="holderFormularioUsuario">

                <p class="tituloFormRecover" for="">Email Enviado!</p>
                <p class="textoFormRecover" for="">Essa aba pode ser fechada.</p>


            </div>
        <?php }
        if ($status == "false") { ?>
            <div class="holderFormularioUsuario">

                <p class="tituloFormRecover" for="">Email de recuperação não foi enviado!</p>
                <p class="textoFormRecover" for="">Favor inserir um email válido</p>
                <form class="formRecover" action="/petiti/api/email-recuperacao.php" method="post">
                    <p class="tituloFormRecover" for="">Esqueceu sua senha?</p>
                    <p class="textoFormRecover" for="">Insira seu email para começar o processo de recuperação.</p>
                    <label class="formTextLogin" for="txtEmail">Email</label>
                    <input class="formInputLogin" type="email" name="txtEmail" id="txtEmail" />
                    <button class="formSubmitLogin" type="submit">Enviar</button>
                </form>

            </div>
        <?php }
        ?>

    <?php } else { ?>
        <div class="holderFormularioUsuario">
            <form class="formRecover" action="/petiti/api/email-recuperacao.php" method="post">
                <p class="tituloFormRecover" for="">Esqueceu sua senha?</p>
                <p class="textoFormRecover" for="">Insira seu email para começar o processo de recuperação.</p>
                <label class="formTextLogin" for="txtEmail">Email</label>
                <input class="formInputLogin" type="email" name="txtEmail" id="txtEmail" />
                <button class="formSubmitLogin" type="submit">Enviar</button>
            </form>
        </div>
    <?php } ?>
</body>

</html>