<?php
@session_start();

include_once("sentinela.php");
?>
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
    <link rel="stylesheet" href="styles/stylesheet.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="images/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</head>
<body class="bodyFeed">  
<main class="holderFeed">
    
   <section id="hud" class="hudHolder" >
        <div class="hud">
            <div class="elementsHud"> 
            <img style="width:200px; padding-left: 27%; padding-top:20px;" src="images/logo_principal.svg" alt="">

            <div class="elementos">
                <div id="elementsHolder">
                    <img src="images/icon-home.svg" alt="">
                    <span class="elementHudText" style="padding-left: 6px;">Home</span>
                </div>
                <div class="elementsHolder">
                    <img src="images/animaisPerdidos-icon.svg" alt="">
                    <span class="elementHudText" style="padding-left: 5px;">Animais perdidos</span>
                </div>
                <div class="elementsHolder">
                    <img src="images/animaisEmDoacao-icon.svg" alt="">
                    <span class="elementHudText" style="padding-left: -1px;">Animais em doação</span>
                </div>
                <div class="elementsHolder">
                    <img src="images/notificacoes.svg" alt="">
                    <span class="elementHudText" style="padding-left: 8px;">Notificações</span>
                </div>
                <div class="elementsHolder">
                    <img src="images/mensagens.svg" alt="">
                    <span class="elementHudText" style="padding-left: 9px;">Mensagens</span>
                </div>
                <div class="elementsHolder">
                    <img src="images/produtos-icon.svg" alt="">
                    <span class="elementHudText" style="padding-left: 5px;">Produtos e Serviços</span>
                </div>
            </div>
                <div class="line"></div>

                <button class="botaoCriarPost">Criar um post</button>
                    </div>

                    <!-- placeholder -->
                    <div class="userElementos">

                        <img class="imagemUser" src="<?php
                        echo $_SESSION['foto'];?>" alt="">

                        <div style="display: flex; flex-direction: column; margin-left: 10px;">
                         
                         <span class="textNomeUsuario"><?php
                        echo $_SESSION['nome'];
                        ?></span>

                        <span class="textLoginUsuario"> <?php
                        echo "@".$_SESSION['login'];
                        ?>
                        </div></span>
                    </div>
            </div>
        </div>
   </section>


    <section id="posts"  class="postsHolder">
        <div class="posts">
            <div class="elementosPosts">

            <div  style=" position: absolute; z-index: 100; " >
            <input class="barraPesquisaFeed" type="search" placeholder="Pesquisar">
            </div>

            <div class="postarFeed">

                <div style="width: 369px; height: 58px; margin-top: 20px; margin-left: 240px;">
                  <span class="textoPostarFeed"> Crie um post anexando uma foto, gif ou vídeo!</span>
                  <span class="textoPostarFeed" style="color: #7A7A7A;"> Compartilhe seu bichinho dormindo...</span>
                </div>

                <span class="placeHolderPostarFeedBotao">Postar</span>
            </div>

            <div class="placeholderPost">
                <img src="images/reações-post.svg" style="width: 130px; margin-top: 102%; margin-left: 20px;" alt="">
                <img src="images/curtida, desc.svg" style="width: 500px; margin-left: 20px;" alt="">
            </div>

            <div class="placeholderPost">
                <img src="images/reações-post.svg" style="width: 130px; margin-top: 102%; margin-left: 20px;" alt="">
                <img src="images/curtida, desc.svg" style="width: 500px; margin-left: 20px;" alt="">
            </div>

            <div class="placeholderPost">
                <img src="images/reações-post.svg" style="width: 130px; margin-top: 102%; margin-left: 20px;" alt="">
                <img src="images/curtida, desc.svg" style="width: 500px; margin-left: 20px;" alt="">
            </div>

            </div>
        </div>
   </section>

    <section id="function" class="functionHolder">
            <div class="function">
                <div class="placeholderFeedAnimalPerdido">
                    <img src="images/feed animal perdido.svg" alt="">
                </div>

                <div class="placeholderCategorias">
                    <img src="images/categorias.svg" alt="">
                </div>

                <div class="placeholderCopyright">
                    <img src="images/copyright.svg" alt="">
                </div>
            </div>
    </section>


</main>


</body>


</html>