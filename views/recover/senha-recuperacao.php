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
    <title>Pet iti - Recuperar a senha</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css" />
</head>

<body>

    <?php if (isset($_GET['emailenviado'])) { ?>

        <?php
        if ($status == "true") { ?>
            <div class="fundoRecuperarSenha">
                <img class="fotoRecover" src="/petiti/assets/images/logo_principal.svg" /></a>

                <div class="formEmailEnviado">
                    <img src="/petiti/views/assets/img/emailEnviado.svg" alt="">
                    <p class="tituloFormRecover" style="margin: 1rem 0 1rem 0" for="">Email enviado!</p>
                    <p class="textoFormRecover" for="">Um link foi enviado para o seu email de cadastro para 
                    a recuperação da sua senha. Você pode <span class="enfaseTexto">fechar</span> essa página agora.</p>
                </div>
            </div>
        <?php }
        if ($status == "false") { ?>
            <div class="funoRecuperarSenha">

                <img  src="/petiti/assets/images/logo_principal.svg" /></a>

                    <form class="formRecover" action="/petiti/api/email-recuperacao.php" method="post">
                    
                        <div class="formRecoverHolder">
                            <img src="/petiti/views/assets/img/cadeado.png" alt="">
                           
                            <h1> Recuperação de senha</h1>
                           
                            <h3>Insira o email utilizado no cadastro de sua conta que enviaremos um link para recuperar sua senha.</h3>
                        
                            <input  type="email" name="txtEmail" id="txtEmail" />

                            <p  for="">Insira um email existente.</p>

                            <button class="btn btn-primary"  type="submit">Continuar</button>
                        
                        </div>


                </form>
            </div>
        <?php }
        ?>

    <?php } else { ?>

        <div class="fundoRecuperarSenha">

           <a href=""><img  src="/petiti/assets/images/logo_principal.svg" /></a>

            <form class="formRecover" action="/petiti/api/email-recuperacao.php" method="post">
                <div class="formRecoverHolder">
                    <img src="/petiti/views/assets/img/cadeado.png" alt="">
                    
                    <h1> Recuperação de senha</h1>
                    
                    <h3>Insira o email utilizado no cadastro de sua conta que enviaremos um link para recuperar sua senha.</h3>



                <input  type="email" name="txtEmail" id="txtEmail" placeholder="Email"/>

                <button class="btn btn-primary"  type="submit">Continuar</button>

            </div>

            </form>
        </div>
    <?php } ?>
</body>

</html>