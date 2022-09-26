<!-- <form action="verificaLogin.php" method="POST">
    <input type="text" name="txtLoginEmail" placeholder="Login ou Email">
    <input type="text" name="pw" placeholder="Senha">
    <input type="submit" value="Entrar">
</form>
 -->

<!DOCTYPE php>
<html lang="pt-br">

<head>
    <!-- HTML base -->
    <base href="http://localhost/petiti/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
</head>

<body style="overflow: hidden;">
    <main class="container-content">
        <section id="loginUsuario">
            <div class="holderLogin">
                <div class="Login">

                    <img class="loginLogo" src="/petiti/views/assets/img/logo_principal.svg" alt="">

                    <form action="verificaLogin.php" method="POST">
                        <div class="loginInputHolder">
                            <label class="formTextLogin">Nome de usúario ou email</label>
                            <input class="formInputLogin" name="txtLoginEmail" placeholder="Nome de usuário ou email" required minlength="4">
                        </div>

                        <div class="loginInputHolder">
                            <label class="formTextLogin">Senha</label>
                            <input class="formInputLogin" type="password" name="pw" placeholder="Senha" required minlength="4">
                        </div>

                        <button class="formSubmitLogin" type="submit">Entrar</button>
                    </form>

                    <span class="textoLogin">
                        Não tem uma conta? <a href="../register/pages/escolha-tipo-usuario.php" class="textoLoginAhref"> Cadastre-se</a>
                    </span>

                    <span class="recuperarSenha">
                        Esqueceu sua senha? <a href="./formularioRecuperacao.php" class="recuperarSenhaAhref"> Recupere</a>
                    </span>


                </div>
        </section>
    </main>
</body>

</html>