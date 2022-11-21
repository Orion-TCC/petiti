<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- título da pág e icone (logo) -->
    <title>Pet iti - Criar uma nova senha</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <script src="/petiti/views/assets/js/recover.js"></script>
</head>

<body>



    <div class="fundoRecuperarSenha">
        <img class="logoNavbar" src="/petiti/assets/images/logo_principal.svg" /></a>

        <?php
        @session_start();
        $nome = $_SESSION['nome-recuperacao'];
        ?>
        <form class="formPassRecover" method="post" action="/petiti/api/usuario/update/senha/recuperacao">
            <div class="formRecoverHolder">
                <span class="tituloFormRecover" for="">Crie uma nova senha</span>

                <label class="formTextLogin" for="novaSenha">Insira sua nova senha</label>
                <input class="formInputLogin" type="password" id="novaSenha" name="novaSenha">

                <label style="margin-top: 20px;" class="formTextLogin" for="confirmNovaSenha">Confirme a senha</label>
                <input class="formInputLogin" type="password" id="confirmNovaSenha" name="confirmNovaSenha">
                <input class="formSubmitLogin" type="submit" value="Atualizar senha">
                <p id="senhaAvisoTamanho"></p>

                <p id="senhaAvisoVerificacao"></p>
            </div>
            
        </form>

        <div class="holderFormularioUsuario">
                <div class="formulario">
                    
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
                            <input class="formInput" autocomplete="off" placeholder="Insira seu email" type="email" name="txtEmailUsuario" id="txtEmailUsuario" required autofocus>
                            <p id="avisoEmail"></p>


                            <label class="formText">Nome de usuário</label>
                            <input class="formInput" autocomplete="off" placeholder="Insira seu nome de usuario" type=" text" name="txtLoginUsuario" id="txtLoginUsuario" required minlength="4">

                            <p class="avisoNomeUsuarioValidacao"></p>
                            <p class="avisoNomeUsuarioQtd"></p>

                            <label class="formText">Senha</label>
                            <div class="formInput">
                                <input  placeholder="Insira sua melhor senha" autocomplete="off" type="password" name="txtPw" id="txtPw" required minlength="6">
                               
                                <i id="revealPassword" onclick="hidePassword()" class="uil uil-eye"></i>
                                <i id="hidePassword" onclick="showPassword()" class="uil uil-eye-slash"></i>
                            </div>
                            <p id="senhaAvisoTamanho"></p>


                            <label class="formText">Confirme sua senha</label>
                            <input class="formInput" autocomplete="off" placeholder="Confirme a senha" type="password" name="txtPwConfirm" id="txtPwConfirm" required minlength="6">
                            <p id="senhaAvisoVerificacao"></p>


                            <button id="submitUsuario" class="formSubmit" type="submit">Continuar</button>

                                <span class="textoErrado" style="align-self: center;"> <?php echo @$_COOKIE["erro-cadastro"];?></span>
                        </form>
                    </div>



                </div>
            </div>
    </div>

</body>

</html>