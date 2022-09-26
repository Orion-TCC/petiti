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
    <link rel="stylesheet" href="assets/styles/stylesheet.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="images/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</head>

<body id="bodyFeed">  

<main class="holderFeed">
    <section class="leftBarHolder">
    <div class="leftBar">
        <img src="./assets/images/logo_principal.svg" class="imgLogoFeed">

        <div class="leftBarMenu">
            <a href="#">Home</a>
            <a href="#">Animais perdidos</a>
            <a href="#">Animais em doação</a>
            <a href="#">Notificações</a>
            <a href="#">Mensagens</a>
            <a href="#">Produto e serviços</a>
        </div>

        <button class="botaoCPost"></button>


    </div>
    </section>






    <section class="postsHolder">

    </section>
    
        <section class="rightBarHolder">

        </section>
</main>

</body>
</html>