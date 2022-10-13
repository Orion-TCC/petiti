<!DOCTYPE php>
<html lang="pt-br">
<?php
session_start();
$_SESSION['tipo-usuario'] = "usuario";
?>

<head>
    <!-- HTML base -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script async src="/petiti/views/assets/js/script-jquery.js"></script>
    <script src="/petiti/views/assets/js/script.js"></script>
</head>

<body>
    <main class="container-content">
        <section id="formularioUsuario">
            <div class="holderFormularioUsuario">
                <div class="formulario">
                   <a class="setaVoltar" href="tipo-usuario"><img src="/petiti/views/assets/img/seta - voltar.svg" alt=""></a>
                    <div class="tituloFormHolder">
                        <span>
                            Vamos começar!
                        </span>
                    </div>
                    <div class="subTituloFormHolderUsuario">
                        <span>
                            Insira seus dados de acesso abaixo:
                        </span>
                    </div>
                    <div class="formularioHolder ">
                        <form class="formElementsHolder" action="api/usuario/add" method="post">
                            <label class="formText">Email</label>
                            <input class="formInput" placeholder="Insira seu email" type="email" name="txtEmailUsuario" id="txtEmailUsuario" required autofocus>

                            <p id="avisoEmail"></p>

                            <label class="formText">Seu nome</label>
                            <input class="formInput" placeholder="Insira seu nome ou apelido" type="text" name="txtNomeUsuario" id="txtNomeUsuario" required minlength="2">
                           
                            <label class="formText">Nome de usuário</label>
                            <input class="formInput" placeholder="Insira seu username" type=" text" name="txtLoginUsuario" id="txtLoginUsuario" required minlength="4">

                            <p class="avisoNomeUsuarioValidacao"></p>
                            <p class="avisoNomeUsuarioQtd"></p>
                         



                            <label class="formText">Senha</label>
                            <input class="formInput" placeholder="Insira sua melhor senha" type="password" name="txtPw" id="txtPw" required minlength="6">
                            <p id="senhaAvisoTamanho"></p>

                            
                            <label class="formText">Confirme sua senha</label>
                            <input class="formInput" placeholder="Confirme a senha" type="password" name="txtPwConfirm" id="txtPwConfirm" required minlength="6">


                            <p id="senhaAvisoVerificacao"></p>
                            <div class="caixaMostrarSenha">
                                <input class="checkboxSenha" type="checkbox" id="mostrarSenha">
                                <label for="mostrarSenha" class="formTextMostrarSenha" id=mostrarSenhaLabel style="cursor: pointer;">Mostrar Senha</label>
                            </div>
                            
                            <button id="submitUsuario" class="formSubmit" type="submit">Continuar</button>
                        </form>
                    </div>


                    <div class="cookieCadastro animate__bounce">
                        <p class="animate__animated animate__tada "><?php echo @$_COOKIE['erro-cadastro'] ?></p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>