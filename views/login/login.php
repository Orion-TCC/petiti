<!DOCTYPE php>
<html lang="pt-br">

<head>
    <!-- HTML base -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css">

    <!-- iconscout icones -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script async src="/petiti/views/assets/js/funcs.js"></script>

</head>

<body style="overflow: hidden;">
    <main class="container-content">
        <section id="loginUsuario">
            <div class="holderLogin">
                <div class="ilustracaoLogin">
                    <img style="margin-left: 500px;" src="/petiti/views/assets/img/ilustracao-login.svg" alt="">
                </div>
                <div class="Login">
                    <a href="/petiti/index.php"><img class="loginLogo" src="/petiti/views/assets/img/logo_principal.svg" alt=""></a>
                    <form class="formLogin" action="/petiti/api/login" method="POST">
                        <div class="loginInputHolder">
                            <label class="formTextLogin">Nome de usúario ou email</label>
                            <input class="formInputLogin" name="txtLoginEmail" placeholder="Nome de usuário ou email" required minlength="4">
                        </div>

                        <div class="loginInputHolder">
                            <label class="formTextLogin">Senha</label>
                            
                            <div style="position: relative;">
                                <input class="formInputLogin" id="txtPw" type="password" name="pw" placeholder="Senha" required minlength="4">
                                
                                <i id="revealPassword" onclick="hidePasswordUm()" class="uil uil-eye"></i>
                                <i id="hidePassword" onclick="showPasswordUm()" class="uil uil-eye-slash"></i>
                            </div>

                        </div>

                        <button class="formSubmitLogin" type="submit">Entrar</button>
                    </form>
                    <?php
                    ?>
                    <?php if (isset($_COOKIE['retorno-login'])) { ?>
                        <div class="textoErrado">
                            <?php echo $_COOKIE['retorno-login'] ?>
                        </div>
                    <?php } ?>
                    <span class="textoLogin">
                        Não tem uma conta? <a href="/petiti/tipo-usuario" class="textoLoginAhref"> Cadastre-se</a>
                    </span>

                    <span class="textoLogin">
                        Esqueceu sua senha? <a href="/petiti/views/recover/senha-recuperacao.php" class="textoLoginAhref "> Recupere</a>
                    </span>
                </div>
        </section>
    </main>
</body>

</html>