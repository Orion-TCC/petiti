<!DOCTYPE php>
<html lang="en">
<?php
session_start();
$_SESSION['tipo-usuario'] = "empresa";
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
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>

    <script async src="/petiti/views/assets/js/script-jquery-foto.js"></script>
    <script async src="/petiti/views/assets/js/script-jquery.js"></script>
</head>

<body>
    <main class="container-content">
        <section id="formularioUsuarioEmpresa">
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


                    <div class="formularioHolder">
                        <form class="formElementsHolder" action="api/usuario/add" method="post">
                            <input type="hidden" value=" " name="txtNomeUsuario">
                          
                            <label class="formText">Email</label>
                            <input class="formInput" placeholder="Insira seu email" type="email" name="txtEmailUsuario" id="txtEmailUsuario">
                            <p id="avisoEmail"></p>

                            <label class="formText">Nome de usuário</label>
                            <input class="formInput" placeholder="Insira seu username" type=" text" name="txtLoginUsuario" id="txtLoginUsuario" required minlength="4">
                            <p class="avisoNomeUsuarioValidacao"></p>
                            <p class="avisoNomeUsuarioQtd"></p>

                            <label class="formText">Senha</label>
                            <div class="formInput">
                                <input  placeholder="Insira sua melhor senha" type="password" name="txtPw" id="txtPw" required minlength="6">
                                <div id="revealPassword" onclick="showHide()"></div>
                            </div>
                            <p id="senhaAvisoTamanho"></p>

                            <label class="formText">Confirme sua senha</label>
                            <input class="formInput" placeholder="Confirme a senha" type="password" name="txtPwConfirm" id="txtPwConfirm" required minlength="6">
                            <p id="senhaAvisoVerificacao"></p>

                            <button class="formSubmit" type="submit">Continuar</button>

                            <span  class="textoErrado" style="align-self: center;"> <?php echo @$_COOKIE["erro-cadastro"];?></span>
                        </form>
                    </div>


                </div>
            </div>
        </section>
    </main>
</body>
                              <script type="text/javascript">
                                const password = document.getElementById ('txtPw');
                                const passwordConfirm = document.getElementById('txtPwConfirm')

                                const toggle = document.getElementById ('revealPassword');

                                function showHide(){
                                    if (password.type === 'password'){
                                        
                                        password.setAttribute('type', 'text');
                                        toggle.classList.add('hide');
                                        passwordConfirm.setAttribute('type', 'text');
                                        toggle.classList.add('hide')
                                    }
                                    else{
                                        password.setAttribute('type', 'password');
                                        toggle.classList.remove('hide')
                                        passwordConfirm.setAttribute('type', 'password');
                                        toggle.classList.remove('hide')  
                                    }
                                }
                              </script>
</html>