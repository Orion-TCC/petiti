<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <script src="/petiti/views/assets/js/recover.js"></script>
</head>

<body>
    <nav id="navRecover">
        <div>
            <a href="#">
                <img class="logoNavbar" src="/petiti/assets/images/logo_principal.svg" /></a>
        </div>
        <div class="textoNavRecover">Recuperação de senha</div>
    </nav>
    <div class="holderFormularioUsuario">
        <?php
        @session_start();
        $nome = $_SESSION['nome-recuperacao'];
        ?>
        <form class="formRecover" method="post" action="/petiti/api/usuario/update/senha/recuperacao">
            <p class="tituloFormRecover" for="">Crie uma nova senha</p>
            <label class="formTextLogin" for="novaSenha">Sua nova senha</label>
            <input class="formInputLogin" type="text" id="novaSenha" name="novaSenha">
            <p id="senhaAvisoTamanho"></p>
            <label class="formTextLogin" for="confirmNovaSenha">Confirme a senha</label>
            <input class="formInputLogin" type="text" id="confirmNovaSenha" name="confirmNovaSenha">
            <input class="formSubmitLogin" type="submit" value="Atualizar senha">
            <p id="senhaAvisoVerificacao"></p>
        </form>

    </div>

</body>

</html>