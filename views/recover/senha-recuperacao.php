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

    <?php if (isset($_GET['emailenviado'])) { ?>

        <?php
        if ($status == "true") { ?>
            <div class="fundoRecuperarSenha">

                <p class="tituloFormRecover" for="">Email Enviado!</p>
                <p class="textoFormRecover" for="">Essa aba pode ser fechada.</p>


            </div>
        <?php }
        if ($status == "false") { ?>
            <div class="fundoRecuperarSenha">
                <img class="fotoRecover" src="/petiti/assets/images/logo_principal.svg" /></a>

                <form class="formRecover" action="/petiti/api/email-recuperacao.php" method="post">
                    <div class="itemsForm">
                        <img src="/petiti/views/assets/img/cadeado.png" alt="">
                        <p class="tituloFormRecover" for="">Recuperação de senha</p>
                        <p class="textoFormRecover" for="">
                            Insira o email utilizado no cadastro de sua conta que enviaremos um link para recuperar sua senha. </p>

                    </div>
                    <input class="formInputLogin" type="email" name="txtEmail" id="txtEmail" />
                    <p class="textoFormRecoverEmail" for="">Favor inserir um email existente</p>

                    <button class="formSubmitLogin" type="submit">Continuar</button>
                </form>
            </div>
        <?php }
        ?>

    <?php } else { ?>
        <div class="fundoRecuperarSenha">
            <img class="fotoRecover" src="/petiti/assets/images/logo_principal.svg" /></a>

            <form class="formRecover" action="/petiti/api/email-recuperacao.php" method="post">
                <div class="itemsForm">
                    <img src="/petiti/views/assets/img/cadeado.png" alt="">
                    <p class="tituloFormRecover" for="">Recuperação de senha</p>
                    <p class="textoFormRecover" for="">
                        Insira o email utilizado no cadastro de sua conta que enviaremos um link para recuperar sua senha. </p>

                </div>
                <input class="formInputLogin" type="email" name="txtEmail" id="txtEmail" />
                <button class="formSubmitLogin" type="submit">Continuar</button>
            </form>
        </div>
    <?php } ?>
</body>

</html>