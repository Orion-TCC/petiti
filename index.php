<?php
session_start();
session_destroy();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="assets/styles/stylesheet.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="assets/images/logo-icon.svg">

    <!--script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</head>


<body>
    <header id="home">
        <nav id="navbar">
            <div>
                <a href="#"> <img class="logoNavbar" src="assets/images/logo_principal.svg"></a>
            </div>

            <div>
                <a href="#postagens" class="navbarElement">Postagens</a>
                <a href="#networking" class="navbarElement">Networking</a>
                <a href="#parcerias" class="navbarElement">Parcerias</a>
            </div>

            <div>
                <a href="/petiti/login/" class="navbarElement">Entrar</a>
                <a href="/petiti/tipo-usuario" class="navbarElementBotao">Cadastre-se</a>
            </div>
        </nav>
    </header>


    <main class="container-content">
        <section id="primeiraPartePage">
            <div class="holderPrimeiraPage">
                <div class="descEilus">
                    <div class="descHolder">
                        <span class="desc"> O MELHOR LUGAR PARA PETLOVERS QUE NEM VOCÊ! </span>
                        <span class="desc2">Uma rede social capaz de ampliar o networking entre petlovers e empresas voltadas para animais.</span>
                    </div>

                    <div>
                        <img src="assets/images/ilustração - pc.svg" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="postagens">
            <div class="holderSegundaPage">
                <div class="textinhoHolder">
                    <div class="textinho">
                        <span class="textin">Poste fotos dos momentos mais fofos dos seus pets!</span>
                    </div>
                </div>


                <div class="textoEpost">
                    <div>
                        <img class="imgPosts" src="assets/images/posts.svg" alt="">
                    </div>

                    <div class="divTexto">
                        <span class="textin2titulo">Sua mais nova rede social, apenas para pets</span>
                        <span class="textin2"> Faça posts de seus melhores momentos com seu melhor amigo e explore seu novo vício. </span>
                        <span class="textin2">Filtre suas publicações e pesquisas para ficarem de acordo com o seu gosto! Assim como irá facilitar que seu círculo de petmigos tenha petlovers com os mesmos interesses que você.</span>
                    </div>
                </div>

            </div>
        </section>

        <section id="networking">
            <div class="holderTerceiraPage">
                <div class="faixaNetworking">
                    <div class="networkingTextoHolder">
                        <span class="networkingTitulo">Networking</span>
                        <span class="networkingTexto">Além de postar fotos, interaja com novas pessoas e compartilhe conhecimento.</span>
                    </div>
                </div>
            </div>
        </section>


        <section id="parcerias">
            <div class="holderQuartaPage">
                <div class="lojinhaHolder">
                    <div class="lojinhaTextTituloHolder">
                        <div>
                            <span class="lojinhaTextTitulo">Além de posts, veja nossas parcerias com petshops da sua região.</span>
                        </div>

                        <div>
                            <span class="lojinhaTextSubTitulo">Tudo que seu pet precisa</span>
                        </div>

                        <div class="lojinhaTextHolder">
                            <span class="lojinhaText">Veja se o <span class="lojinhaTextStyle">petshop</span>, <span class="lojinhaTextStyle">casa de ração</span> ou até <span class="lojinhaTextStyle">mesmo banho e tosa</span> da sua região criou um perfil na nossa rede social e seja capaz de ver os produtos que ele oferece.</span>
                        </div>
                    </div>

                    <div>
                        <img class="lojinhaImg" src="assets/images/lojinha - petshop.svg" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="QuintaPartePage">

            <div class="holderQuintaPage">
                <img class="leandro" src="assets/images/leandro.svg" alt="">


                <div class="funcionalidadesHolder">
                    <div class="baloesFuncionalidades">

                        <div class="balaoFuncionalidade">
                            <img class="iconeFuncionalidade" src="assets/images/coração quebrado.svg" alt="">
                            <span class="textoFuncionalidade">Animais perdidos</span>
                        </div>

                        <div class="balaoFuncionalidade">
                            <img class="iconeFuncionalidade" src="assets/images/caixa.svg" alt="">
                            <span class="textoFuncionalidade">Animais em adoção</span>
                        </div>

                    </div>

                    <div class="textosFuncionalidades">
                        <span class="funcionalidadesTitulo">Funcionalidades especiais </span>
                        <span class="funcionalidadesSubTitulo">Feeds exclusivos</span>
                        <span class="funcionalidadesTextos">Muitas vezes posts sobre animais perdidos e animas em adoção são ignorados, então, resolvemos fazer feeds exclusivos para esses tópicos, para que eles tenham o engajamento que precisam e merecem.</span>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer class="container-footer">

        <a href="#">
            <img class="imgSetaTopo" src="assets/images/setinha-topo.svg" alt="">
        </a>

        <div class="FooterHolder">
            <a href="#postagens" class="FooterElement">Postagens</a>
            <a href="#networking" class="FooterElement">Networking</a>
            <a href="#parcerias" class="FooterElement">Parcerias</a>
            <a href="#" class="FooterElement">Sobre a empresa</a>
        </div>

        <div class="FooterHolder2">
            <a href="#" class="FooterElement">Entrar</a>
            <a href="/petiti/tipo-usuario" class="FooterElement">Cadastre-se</a>
        </div>
        <div class="FooterHolder3">
            <span class="FooterElement">Copyright © Orion - 2022. Todos os direitos reservados.</span>
        </div>
    </footer>

</body>
<script>
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 50) {
            $('#navbar').css('background-color', 'rgba(255, 255, 255, 0.3)');
        } else {
            $('#navbar').css('background', 'transparent');
        }
    });
</script>

</html>