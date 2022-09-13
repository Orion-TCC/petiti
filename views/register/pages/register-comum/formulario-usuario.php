<!DOCTYPE php>
<html lang="pt-br">
    
<head>
    <!-- HTML base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../../../assets/css/style.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="../../../assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="../../../assets/js/script.js" async></script>
    </head>
<body>
    <main class="container-content">
        <section id="formularioUsuario">
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
                    <form class="formElementsHolder" action="controllers/controller-usuario.php" method="post">

                        <label class="formText">Email</label>
                    <input class="formInput" placeholder="Insira seu email"type="email" name="txtEmailUsuario" id="txtEmailUsuario" required autofocus >

                        <label class="formText">Seu nome</label>
                    <input class="formInput" placeholder="Insira seu nome ou apelido"type="text" name="txtNomeUsuario" id="txtNomeUsuario" required minlength="2" >

                        <label class="formText">Nome de usuário</label>
                    <input class="formInput" placeholder="Insira seu username"type=" text" name="txtLoginUsuario" id="txtLoginUsuario" required minlength="4" >

                        <label class="formText">Senha</label>
                    <input class="formInput" placeholder="Insira sua melhor senha"type="password" name="txtPw" id="txtPw" required minlength="6" >

                        <label class="formText">Confirme sua senha</label>
                    <input class="formInput" placeholder="Confirme a senha"type="password" name="txtPwConfirm" id="txtPwConfirm" required minlength="6" >
                    <button class="formSubmit" type="submit">Continuar</button>
                           
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