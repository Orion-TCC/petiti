<?php
@session_start();
require_once('../../api/classes/curtidaPublicacao.php');
$curtidaPub = new curtidaPublicacao();
date_default_timezone_set('America/Sao_Paulo');
include_once("../../sentinela.php");
$idUsuarioCurtida = $_SESSION['id'];
$id = $_SESSION['id'];
$urlPets = "http://localhost/petiti/api/usuario/$id/pets";

$jsonPets = file_get_contents($urlPets);

$dadosPets = (array) json_decode($jsonPets, true);

$contagemPets = count($dadosPets['pets']);
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
    <link rel="stylesheet" href="/petiti/assets/css/feed-style.css">
    <link rel="stylesheet" href="/petiti/assets/css/opcoes-style.css">
    <link rel="stylesheet" href="/petiti/assets/css/usuario-style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - Feed</title>


    <link rel="icon" href="/petiti/assets/images/logo-icon.svg">

    <!--script-->

    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>
    <script src="/petiti/assets/js/jquery-scripts.js"></script>
    <script src="/petiti/assets/js/script.js"></script>
    <script src="/petiti/views/assets/js/funcs.js"></script>

</head>

<body class="feed">

    <nav class="feed">
        <div class="container">

            <div class="popupOptions" id="popup">

                <div class="flex-col">

                    <div class="flex-row">
                        <div class="fotoDePerfil">
                            <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                        </div>
                        <h3><?php echo $_SESSION['nome']; ?></h3>
                    </div>

                    <?php for ($p = 0; $p < $contagemPets; $p++) { ?>
                        <div class="flex-row petUser">

                            <a class="hrefNomePet" href="/petiti/api/escolher-pet/<?php echo $dadosPets['pets'][$p]['idPet'] ?>">
                                <div class="fotoDePerfil">
                                    <img src="<?php echo $dadosPets['pets'][$p]['caminhoFotoPet'] ?>" alt="">
                                    <!--Foto do pet  -->
                                </div>

                                <h3><?php echo $dadosPets['pets'][$p]['nomePet'] ?></h3>
                            </a>
                        </div>
                    <?php    } ?>
                </div>


                <div class="flex-col borderTop row-gap opcoesPopUp">

                    <h3 style="width: 15rem;">Adicionar conta existente</h3>

                    <h3>Gerenciar contas</h3>

                    <h3> <a href="opcoes">Configurações</a></h3>

                    <h3><a href="sair" class="botaoLogout"> <i class="uil uil-sign-out-alt"></i> Sair</a></h3>

                </div>

            </div>

            <h2 class="logo">
                <img src="/petiti/assets/images/logo_principal.svg">
            </h2>
            <div class="caixa-de-busca">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Pesquisar">
            </div>

            <?php

            if (isset($_COOKIE['denuncia'])) {
                echo $_COOKIE['denuncia'];
            }

            ?>


            <div class="opcoes" id="opcoes" onclick="showPopUp()">
                <label for="abrir-opcoes" id="labelAO"><i class="uil uil-setting" ></i></label>

                <div class="fotoDePerfil" id="fotoDePerfil">
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="" id="fotoDePerfilOpcoes">
                </div>

            </div>

        </div>
    </nav>


    <script>
                window.onload = function() {
                    var hidediv = document.getElementById('popup');

                    document.onclick = function(div) {
                        if (div.target.id !== 'popup' && div.target.id !== 'opcoes' ) {
                            hidediv.style.display = "none";
                        }
                    };

                };


            </script>

    <main class="feed">



        <div class="container">


            <!-- LADO ESQUERDO -->
            <div class="ladoEsquerdo">

                <a href="/petiti/decidir-perfil" class="perfil">
                    <div class="fotoDePerfil">
                        <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                    </div>
                    <div class="handle">
                        <h4><?php echo $_SESSION['nome']; ?></h4>
                        <p class="text-muted">
                            <?php echo "@" . $_SESSION['login']; ?>
                        </p>
                    </div>
                </a>
                <!-- SIDEBAR LADO ESQUERDO -->

                <div class="sidebar">
                    <a href="feed" class="menu-item ">
                        <span><i class="uil uil-house-user"></i> </span>
                        <h3>Home</h3>
                    </a>

                    <a href="animaisPerdidos" class="menu-item">
                        <span><i class="uil uil-heart-break"></i></span>
                        <h3>Animais perdidos</h3>
                    </a>

                    <a href="animaisEmAdocao" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>
                        <h3>Animais em doação</h3>
                    </a>


                    <a href="notificacoes" class="menu-item">
                        <span><i class="uil uil-bell"></i> </span>
                        <h3>Notificações</h3>
                    </a>

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-envelope"></i> </span>
                        <h3>Mensagens</h3>
                    </a>

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-shopping-bag"></i> </span>
                        <h3>Produtos e Serviços</h3>
                    </a>

                    <a href="paraVoce" class="menu-item">
                        <span><i class="uil uil-coffee"></i> </span>
                        <h3>Para Você</h3>
                    </a>
                </div>

                <!-- Botao de criar post -->
                <button class="btn btn-primary">
                    <p>
                        <a href="#modal-foto-post" rel="modal:open">Criar um Post</a>
                    </p>
                </button>

            </div>
            <!-- FIM DO LADO ESQUERDO -->

            <div class="meio">

                <span>Configurações</span>

                <div class="opcoesHolder">

                    <div class="sidebar">
                        <button class="menu-item" onclick="openTab(event, '1')" id="defaultOpen">Editar perfil</button>
                        <button class="menu-item" onclick="openTab(event, '2')">Alterar senha</button>
                        <button class="menu-item" onclick="openTab(event, '3')">Adicionar outro pet</button>
                        <button class="menu-item" onclick="openTab(event, '4')">Privacidade e segurança</button>
                    </div>



                 <div class="tabs-conteudo tabHolder editarPerfil" id="1">
                    <form action="">

                        <div class="imageHandler">

                            <div class="flex-row">
                                <div class="fotoDePerfil">
                                    <img src="#" alt="">
                                </div>


                                <label class="flFotoPerfil">
                                <input id="flFotoPerfil" type="file" accept=".jpg, .png">
                                </label>
                            </div>


                                <div class="flex-col">
                                    <h2>@username</h2>
                                    <label class="flFotoPerfil">
                                        Alterar foto de perfil
                                        <input id="flFotoPerfil" type="file" accept=".jpg, .png">
                                    </label>
                                </div>

                        </div>

                        <div class="informacoes">
                            
                            <div class="infoArea">
                                <h3>Nome</h3>
                                <input type="text" placeholder="Nome">
                                <h5 class="text-muted">*Ajude as pessoas a descobrir sua conta usando o nome pelo qual você é conhecido.</h5>
                            </div>

                            <div class="infoArea">
                                <h3>Nome de Usuario</h3>
                                <input type="text" placeholder="Nome de usuario">
                                <h5 class="text-muted">*Você pode mudar quantas vezes você quiser se o nome de usuário desejado estiver disponível para uso.</h5>
                            </div>

                            <div class="infoArea infoPessoal">
                                <h3>Informações pessoais</h3>
                                <h5 class="text-muted">Forneça suas informações pessoais mesmo se o seu perfil for para uso pessoal. Ela não farão parte do seu perfil público.</h5>
                            </div>

                            <div class="infoArea">
                                <h3>Email</h3>
                                <input type="text" placeholder="Email">
                            </div>

                            <div class="botoesInfoArea">
                                <button class="btn btn-primary">Salvar</button>
                                <label class="hover-2 hvr-buzz">Desativar conta</label>
                            </div>

                        </div>

                     </form>


                    </div>



                    <div class="tabs-conteudo tabHolder alterarSenha" id="2">
                        <form action="">
                                <div class="imageHandler">

                                    <div class="flex-row">
                                        <div class="fotoDePerfil">
                                            <img src="#" alt="">
                                        </div>
                                    </div>
                                        <h2>@username</h2>
                                    </div>

                                    <div class="informacoes">

                                    <div class="infoArea">
                                        <h3>Senha antiga</h3>
                                        <input type="text" placeholder="Senha antiga">
                                    </div>

                                    <div class="infoArea">
                                        <h3>Senha nova</h3>
                                        <input type="text" placeholder="senha nova">
                                    </div>

                                    <div class="infoArea">
                                        <h3>Confirmar senha nova</h3>
                                        <input type="text" placeholder="Confirmar senha nova">
                                    </div>

                                    <div class="botoesInfoArea">
                                        <button class="btn btn-primary">Alterar senha</button>
                                        <label class="hover-2 ">Esqueceu a senha?</label>
                                   </div>

                                    </div>

                            </div>
                        </form>
                    
                    
                    <div class="tabs-conteudo tabHolder adicionarPet" id="3">
                        <form action="">

                            <div class="imageHandler">

                                <div class="flex-row">
                                    <div class="fotoDePerfil">
                                        <img src="#" alt="">
                                    </div>


                                    <label class="flFotoPerfil">
                                    <input id="flFotoPerfil" type="file" accept=".jpg, .png">
                                    </label>
                                </div>


                                    <div class="flex-col">
                                        <h3>Escolha a melhor foto do seu pet</h3>
                                        <h5 class="text-muted">*Caso não tenha escolhido uma foto, você poderá fazer isso depois</h5>
                                    </div>

                            </div>

                            <div class="informacoes">
                                
                                <div class="infoArea">
                                    <h3>Nome</h3>
                                    <input type="text" placeholder="Nome">
                                </div>

                                <div class="infoArea">
                                    <h3>Nome de Usuario</h3>
                                    <input type="text" placeholder="Nome de usuario">
                                </div>

                                <div class="infoArea">
                                    <h3>Espécie</h3>
                                    <input type="text" placeholder="Insira a especie">
                                </div>

                                <div class="infoArea">
                                    <h3>Raça</h3>
                                    <input type="text" placeholder="Insira a raça">
                                </div>

                                <div class="infoArea idadePet">
                                    <h3>Idade</h3>
                                        <div class="inputTextIdade">
                                            <input type="text" placeholder="Insira a idade">
                                            <input type="text" placeholder="Ano(s)">
                                        </div>
                                </div>

                                <div class="botoesInfoArea">
                                    <button class="btn btn-primary">Salvar</button>
                                </div>

                            </div>

                        </form>

                    </div>
                    
                    <div class="tabs-conteudo tabHolder" id="4">

                    </div>

                </div>

            </div>

<script>
    document.getElementById("defaultOpen").click();
</script>


        <!-- Modal Post -->
        <section id="post">

            <div id="modal-foto-post" class="modal">
                <div class="modal-foto-post">
                    <div class="tituloModalPost">Criar um post</div>
                    <div class="inputArea">

                        <div class="fotoSelecionarImagem">
                            <img src="./assets/images/selectFotoIlustracao.png">
                        </div>

                        <span class="textPadrao">Arraste fotos, vídeos ou gifs aqui</span>

                        <label class="btn inputButtonEstilo">
                            <input class="inputForm" type="file" accept="image/*" id="flFoto">
                            <span>Selecionar no computador</span>
                            <label>
                    </div>
                </div>

            </div>

            <!-- <script>
    var holder = document.getElementById('modal-foto-post');
    holder.ondragover = function() {
        this.className = 'hover';
        return false;
    };
    holder.ondragend = function() {
        this.className = '';
        return false;
    };
    holder.ondrop = function(e) {
        this.className = '';
        e.preventDefault();
        readfiles(e.dataTransfer.files);
    }
</script> -->

            </div>
        </section>


        <section>
            <div id="modal-recortar-foto" class="modal">
                <div class="tituloModalPost">

                    <div style="width: 60%; display: flex; justify-content: end;"><span>Recortar</span></div>
                    <div style="width: 42.5%; display: flex; justify-content: end; padding-right: 15px;"> <a id="continuar-post" href="#criar-post" rel="modal:open">Continuar</a> </div>

                </div>

                <div id="upload-demo"></div>

            </div>
        </section>

        <section>
            <div id="criar-post" class="modal">
                <form id="form-aid" method="post" action="./api/publicar">
                    <div class="tituloModalPost">
                        <div style="width: 60%; display: flex; justify-content: end;"><span>Criar um post</span></div>

                        <div style="width: 42.5%; display: flex; justify-content: end; padding-right: 15px;">
                            <input class="submitCriarPost" type="submit" value="Compartilhar">
                        </div>
                    </div>

                    <div style="display: flex; flex-direction: row;">
                        <div>
                            <div id="preview-crop-image"></div>
                        </div>

                        <div class="criarPostElements">

                            <div class="parte1CriarPost">

                                <div class="userElementos">

                                    <div class="fotoDePerfil">
                                        <img class="imagemUser" src="<?php echo $_SESSION['foto']; ?>" alt="">
                                    </div>

                                    <span class="textNomeUsuario"><?php echo $_SESSION['nome']; ?></span>
                                </div>


                                <textarea name="txtLegendaPub" id="txtLegendaPub" placeholder="Escreva uma legenda para sua foto!" maxlength="200"></textarea>

                                <input type="hidden" name="categoriasValue" id="categoriasValue" value="">

                                <input type="hidden" name="baseFoto" id="baseFoto">


                                <div class="letraCont">
                                    <div class="contagemChar">
                                        <input type="text" value="0" id="contagemCharInput" disabled>
                                        <span>/200</span>
                                    </div>
                                </div>

                            </div>

                            <div class="parte2CriarPost">
                                <input placeholder="Adicione uma localização" type="text" name="txtLocalizacao">
                                <i class="uil uil-map-marker"></i>
                            </div>

                            <div class="parte3CriarPost">

                                <div class="categoriaSelectTitulo">
                                    <span>
                                        Categoria
                                    </span>
                                </div>
                                <div id="categoriasHolder">

                                    <span class="text-muted">
                                        Insira categorias no seu post e você irá alcançar mais engajamento e até mesmo ajudar a filtrar a “Para você” de outros petlovers/petmigos.
                                    </span>

                                    <div style="display: grid; grid-template-columns: repeat(10, 1fr); width: 100%;">
                                        <input type="text" name="txtCategoria" id="txtCategoria" placeholder="Ex: Lhama">
                                        <p id="submitCategoria"><i class="uil uil-plus"></i></p>
                                    </div>

                                    <div class="categoriasChecksHolder">
                                        <?php $urlCategorias = "http://localhost/petiti/api/categorias";
                                        $jsonCategorias = file_get_contents($urlCategorias);
                                        $dadosCategoria = (array)json_decode($jsonCategorias, true);
                                        $contagemCategoria = count($dadosCategoria['categorias']);
                                        for ($i = 0; $i < $contagemCategoria; $i++) {
                                        ?>

                                            <div class="categoriaSelector">
                                                <input class="checkbox" type="checkbox" name="categorias[]" id="<?php echo $dadosCategoria['categorias'][$i]['categoria']; ?>" value="<?php echo $dadosCategoria['categorias'][$i]['categoria']; ?>">
                                                <?php echo $dadosCategoria['categorias'][$i]['categoria']; ?>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
            </div>
            </form>
            </div>
        </section>

        <section>
            <a href="#modal-denuncia" rel="modal:open">
                    <div id="modal-denuncia" class="modal">
                        <form class="formDenuncia" method="POST" action="/petiti/api/denunciaPublicacao">
                            <input type="hidden" id="idPost" name="idPost" value="">
                            <input type="hidden" id="idUsuarioPub" name="idUsuarioPub" value="">
                            <span class="spanDenuncia">Denuniar</span>
                            <input type="text" name="txtDenuncia" id="txtDenuncia" placeholder="Ex: Maus tratos ao animal presente na publicação">
                            <input class="submitDenuncia" type="submit" value="Denunciar">
                        </form>
                    </div>
        </section>

        <!-- fim Modals -->

    </main>

</body>

</html>