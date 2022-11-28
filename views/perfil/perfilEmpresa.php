<?php
@session_start();
require('../../api/classes/curtidaPublicacao.php');
require('../../api/classes/Usuario.php');

$curtidaPub = new curtidaPublicacao();
date_default_timezone_set('America/Sao_Paulo');

$id = $_SESSION['id'];

include_once("../../sentinela.php");
$idUsuarioCurtida = $_SESSION['id'];

$url = "http://localhost/petiti/api/publicacoes/usuario/" . $_SESSION['id'];

$json = file_get_contents($url);
$dados = (array)json_decode($json, true);
$contagem = count($dados['publicacoes']);


$urlProdutos = "http://localhost/petiti/api/produtos/" . $_SESSION['id'];

$jsonProdutos = file_get_contents($urlProdutos);
$dadosProdutos = (array)json_decode($jsonProdutos, true);
$contagemProdutos = count($dadosProdutos['produtos']);

$urlServicos = "http://localhost/petiti/api/servicos/" . $_SESSION['id'];

$jsonServicos = file_get_contents($urlServicos);
$dadosServicos = (array)json_decode($jsonServicos, true);
$contagemServicos = count($dadosServicos['servicos']);

$urlCurtidas = "http://localhost/petiti/api/publicacoes/curtidas/" . $_SESSION['id'];

$jsonCurtidas = file_get_contents($urlCurtidas);
$dadosCurtidas = (array)json_decode($jsonCurtidas, true);
$contagemCurtidas = count($dadosCurtidas['publicacoes']);

$conexao = Conexao::conexao();
$query = "SELECT COUNT(idUsuarioSeguidor) as qtdSeguindo FROM tbUsuarioSeguidor WHERE idSeguidor = $id";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdSeguindo = $lista[0]['qtdSeguindo'];

$query = "SELECT COUNT(idUsuarioSeguidor) as qtdSeguidores FROM tbUsuarioSeguidor WHERE idUsuario = $id";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdSeguidores = $lista[0]['qtdSeguidores'];

$query = "SELECT COUNT(idProduto) as qtdProdutos FROM tbProduto WHERE idUsuario = $id";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdProduto = $lista[0]['qtdProdutos'];
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
    <link rel="stylesheet" href="/petiti/assets/css/usuario-style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>
    <script src="/petiti/assets/js/jquery-scripts.js"></script>
    <script src="/petiti/assets/js/script.js"></script>
    <script src="/petiti/views/assets/js/funcs.js"></script>

    <!-- título da pág e icone (logo) -->

    <title>Pet iti - meu perfil </title>


    <link rel="icon" href="/petiti/assets/images/logo-icon.svg">

    <!--script-->

    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>
    <script src="/petiti/views/assets/js/script-jquery-foto.js"></script>
    <script src="/petiti/assets/js/script.js"></script>
    <script src="/petiti/views/assets/js/funcs.js"></script>
</head>

<body class="feed perfilUsuario">

    <?php if (isset($_COOKIE["produtoCadastrado"])) {
        echo $_COOKIE["produtoCadastrado"];;
    } ?>

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
                </div>


                <div class="flex-col borderTop row-gap opcoesPopUp">

                    <h3 style="width: 15rem;">Adicionar conta existente</h3>

                    <h3>Gerenciar contas</h3>

                    <h3> <a href="opcoes">Configurações</a></h3>

                    <h3><a href="sair" class="botaoLogout"> <i class="uil uil-sign-out-alt"></i> Sair</a></h3>

                </div>

            </div>
            <h2 class="logo">
                <a href="feed"><img src="/petiti/assets/images/logo_principal.svg"></a>
            </h2>
            <div class="caixa-de-busca">
                <i class="uil uil-search"></i>
                <input class="inputSearch" autocomplete="off" id="inputSearch" type="search" placeholder="Pesquisar">
                <div id="resultadoPesquisa" class="resultadoPesquisa">
                </div>
            </div>

            <script>
                window.onload = function() {
                    var hidediv = document.getElementById('popup');
                    document.onclick = function(div) {
                        if (div.target.id !== 'popup' && div.target.id !== 'opcoes') {
                            hidediv.style.display = "none";
                        }
                    };
                };
            </script>

            <div class="opcoes" id="opcoes" onclick="showPopUp()">
                <div id="labelAO"><i class="uil uil-setting"></i></div>
                <div class="fotoDePerfil">
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                </div>
            </div>
        </div>
    </nav>

    <main class="feed">
        <div class="container">


            <!-- LADO ESQUERDO -->
            <div class="ladoEsquerdo">

                <a class="perfilAtivo">
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
                    <a href="feed" class="menu-item">
                        <span><i class="uil uil-house-user"></i> </span>
                        <h3>Home</h3>
                    </a>

                    <a href="animaisPerdidos" class="menu-item">
                        <span><i class="uil uil-heart-break"></i></span>
                        <h3>Animais perdidos</h3>
                    </a>

                    <a href="animaisEmAdocao" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>
                        <h3>Animais para adoção</h3>
                    </a>


                    <a href="notificacoes" class="menu-item">
                        <span style="position: relative;">
                            <i class="uil uil-bell notificacao"></i>
                            <div class="notificacaoContador"><span>1</span></div>
                        </span>
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

            <div class="Meio">
                <div class="userArea">

                    <div class="userHandle">

                        <div class="userCima">
                            <div class="fotoDePerfil">
                                <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                            </div>

                            <div class="userInfo">

                                <div class="infoHolder topo">
                                    <div class="flex-row" style="gap: 2rem;">
                                        <h2><?php echo $_SESSION['login']; ?></h2>
                                        <a rel="modal:open" href="#modal-editar-perfil" class="btn btn-primary">Editar perfil</a>
                                    </div>
                                </div>

                                <div class="modal" id="modal-editar-perfil">

                                    <form class="flex-col" action="/petiti/api/editar-perfil" method="post">

                                        <div class="editPerfilHeader">
                                            <div class="flex-row">
                                                <a style="display: block !important;" href="#close-modal" rel="modal:close"><i class="uil uil-multiply"></i></i></a>
                                                <h2>Editar perfil</h2>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Salvar</button>

                                        </div>

                                        <div class="editarPerfilForm">

                                            <div class="flex-row">

                                                <img class="fotoDePerfil" id="preview" src="<?php echo $_SESSION['foto'] ?>">

                                                <label class="flFotoPerfil">
                                                    <input id="flFotoPerfil" type="file" accept=".jpg, .png">
                                                </label>

                                                <input value="0" id="baseFoto" type="hidden" name="baseFoto">

                                                <h2>
                                                    <label class="flFotoPerfil2">
                                                        Alterar foto do perfil
                                                        <input id="flFotoPerfil" type="file" accept=".jpg, .png">
                                                    </label>
                                                </h2>

                                            </div>

                                            <div class="flex-col">
                                                <label class="text-bold" for="">Nome</label>
                                                <input placeholder="Nome" value="<?php echo $_SESSION['nome'] ?>" type="text" name="txtNome" id="txtNome" autocomplete="off" maxlength="40">
                                            </div>

                                            <div class="flex-col">
                                                <label class="text-bold" for="">Local</label>
                                                <input <?php if ($_SESSION['local'] != null) { ?> value="<?php echo $_SESSION['local'] ?>" <?php } ?> placeholder="Localização" type="text" name="txtLocal" id="txtLocal" autocomplete="off" maxlength="40">
                                            </div>

                                            <div class="flex-col">
                                                <label class="text-bold" for="">Site</label>
                                                <input class="a-text" <?php if ($_SESSION['site'] != null) { ?>value="<?php echo $_SESSION['site'] ?>" <?php } ?> placeholder="URL" type="text" name="txtSite" id="txtSite" autocomplete="off" maxlength="40">
                                            </div>

                                            <div class="flex-col biografia">
                                                <label class="text-bold" for="">Biografia</label>
                                                <textarea style="resize: none;" placeholder="Escreva alguns fatos sobre você..." autocomplete="off" type="text" name="txtBio" id="txtBio" maxlength="200"><?php if ($_SESSION['bio'] != null) { ?><?php echo $_SESSION['bio'] ?><?php } ?></textarea>


                                                <div class="contagemChar">
                                                    <div class="flex-row" style="width: 100%; justify-content: end;">
                                                        <input type="text" class="contagemCharBioInput" value="0" id="contagemCharBioInput" disabled>
                                                        <span>/200</span>
                                                    </div>
                                                </div>



                                                <!-- <div class="contagemChar">

                                <div class="flex-row" style="width: 100%; justify-content: end;">
                                    <input type="text" class="contagemCharInput" value="0" id="contagemCharInput<?php echo $id; ?>" disabled>
                                    <span>/200</span>
                                </div>
                            </div> -->

                                            </div>

                                        </div>

                                    </form>
                                </div>

                                <div id="modal-recortar-foto-perfil" class="modal">
                                    <div class="flex-col">
                                        <span>Redimensione sua imagem!</span>

                                        <div id="upload-demo"></div>

                                        <a class="btn btn-primary">
                                            <span id="continuar-crop-foto-perfil" style="padding-block: 10px; padding-inline: 87px;">Confirmar</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="infoHolder meio">
                                    <h3> <?php echo $contagem ?> <span class="text-muted"> postagens </span></h3>
                                    <h3 class="hSeguidores" id="<?php echo $id; ?>"><a href="#modal-seguidores" rel="modal:open" style="color: black;"> <span id="seguidores"> <?php echo $qtdSeguidores ?> </span> <span class="text-muted">seguidores</span></a></h3>
                                    <h3 class="hSeguindo" id="<?php echo $id ?>"><a href="#modal-seguindo" rel="modal:open" style="color: black;"><?php echo $qtdSeguindo ?> <span class="text-muted">Seguindo</span></a></h3>
                                </div>

                                <div class="infoHolder baixo">
                                    <div style="width: 15rem; display: flex; align-items: center;">
                                        <i class="uil uil-map-marker"></i>
                                        <h4><?php echo $_SESSION['local'] ?></h4>
                                    </div>

                                    <div style="width: 15rem; display: flex; align-items: center;">
                                        <i class="uil uil-link-alt"></i> <a target="_blank" href="http://<?php echo $_SESSION['site'] ?>"><?php echo $_SESSION['site'] ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="userBaixo">

                            <div class="subUserBaixo">
                                <div style="width: fit-content; max-width: 25rem; display: flex; align-items: center;">
                                    <h2><?php echo $_SESSION['nome']; ?></h2>
                                </div>

                                <h4 class="text-muted"><?php echo ($_SESSION['tipo']); ?></h4>
                            </div>

                            <div class="bio">
                                <?php
                                if ($_SESSION['bio'] == null) { ?>
                                    <h4 class="text-muted"><?php echo $_SESSION['bio'] ?> Adicione uma biografia! Conte um pouco sobre você :D</h4>
                                <?php } else { ?>
                                    <h4 class="text-muted"><?php echo $_SESSION['bio'] ?></h4>
                                <?php }
                                ?>
                            </div>

                        </div>

                        <a href="#modal-servico-produto" rel="modal:open">Cadastrar serviço ou Produto</a>
                    </div>
                    <!-- fim da parte de informacao do usuario -->

                    <div class="tabs">

                        <div class="userTabs ">
                            <button class="userTabOption userTabOption--ativo " data-for-tab="1">Postagens</button>
                            <button class="userTabOption" data-for-tab="2">Produtos</button>
                            <button class="userTabOption" data-for-tab="3">Serviços</button>
                        </div>
                        <!-- fim das tabs de navegacao de usuario -->

                        <div class="tabs_content postagens tabAtiva" data-tab="1">
                            <?php

                            if ($contagem < 1) { ?>
                                <div class="aviso">
                                    <h3>Não há postagens ainda. Faça uma clicando no botão “Criar um post”!</h3>
                                </div>

                                <?php } else {

                                for ($i = 0; $i < $contagem; $i++) {
                                    $foto = $dados['publicacoes'][$i]['caminhoFoto'];
                                ?>
                                    <div class="previewPostImage">
                                        <img src="<?php echo $foto ?>" alt="">
                                    </div>

                            <?php }
                            } ?>

                        </div>

                        <div class="tabs_content produtos" data-tab="2">

                            <?php if ($contagemProdutos < 1) { ?>
                                <a href="#modal-servico-produto" rel="modal:open">
                                    <div class="adicionarProduto">
                                        <i class="uil uil-plus-circle"></i>
                                    </div>
                                </a>
                                <div class="aviso">
                                    <h3>Você não possui nenhum produto ainda... Clique no quadrado acima para começar a vender seus produtos!</h3>
                                </div>
                                <?php } else {
                                for ($p = 0; $p < $contagemProdutos; $p++) {
                                    $foto = $dadosProdutos['produtos'][$p]['caminhoFotoProduto'];
                                ?>
                                    <div class="previewPostImage">
                                        <img src="<?php echo $foto; ?>">
                                    </div>
                            <?php
                                }
                            } ?>
                        </div>


                        <div class="tabs_content serviços" data-tab="3">

                            <?php if ($contagemServicos < 1) { ?>
                                <a href="#modal-servico-produto" rel="modal:open">
                                    <div class="adicionarProduto">
                                        <i class="uil uil-plus-circle"></i>
                                    </div>
                                </a>
                                <div class="aviso">
                                    <h3>Você não possui nenhum serviço ainda... Clique no quadrado acima para começar a vender seus serviços!</h3>
                                </div>
                                <?php } else {
                                for ($b = 0; $b < $contagemServicos; $b++) {
                                    $fotoServico = $dadosServicos['servicos'][$b]['caminhoFotoServico'];
                                ?>
                                    <div class="previewPostImage">
                                        <img style="" src="<?php echo $fotoServico; ?>">
                                    </div>
                            <?php
                                }
                            } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- fim do meio -->

        </div>


        <!-- MODALS -->

        <section>
            <div id="modal-post" class="modal post">
                <div style="display: flex; width: 100%; height: 100%;">

                    <div id="preview-crop-image">
                        <img src="#" alt="">
                    </div>


                    <div class="rightSidePost">

                        <div class="userElementosHolder">
                            <div class="userElementos">
                                <img src="#" alt="" class="fotoDePerfil">
                                <div>
                                    <span class="textNomeUsuario">nome</span>
                                    <h5 class="text-muted">data</h5>
                                </div>
                            </div>

                            <div class="editButton">
                                <div class="menuPostHover"></div>
                                <i class="uil uil-ellipsis-v"></i>
                            </div>
                        </div>

                        <div class="comentariosHolder">

                            <div class="comentarioHolder">

                                <div class="fotoDePerfil">
                                    <img src="#" alt="">
                                </div>

                                <div class="comentarioInfos">

                                    <div class="info">
                                        <div style="  word-break: break-all;">
                                            <h4 class="text-muted"><span style="color: black;">Nome</span> comentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentariocomentario</h4>
                                        </div>
                                    </div>

                                    <div class="info">
                                        <h5 class="text-muted">tempo</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="botoesInteracao">

                            <input class="curtir" value="<?php echo $id ?>" type="checkbox">

                            <button class="comentar"></button>

                            <button class="mensagem"></button>

                        </div>

                        <div class="curtidas">
                            <h4>0 itimalias</h4>

                        </div>

                        <div class="commentArea">

                            <i class="uil uil-heart"></i>

                            <textarea oninput="auto_grow(this)" cols="30" rows="10" placeholder="Adicione um comentário!" maxlength="200" name="txtComentar<?php echo $id ?>" id="txtComentar<?php echo $id ?>"></textarea>

                            <button value="<?php echo $id ?>" class="comentar" value="">
                                <i class="uil uil-message"></i>
                            </button>

                        </div>

                    </div>

                </div>

            </div>
            </div>
        </section>

        <section>
            <div class="modal" id="modal-servico-produto">
                <h1 id="TituloModalServicoProduto">Adicionar produto/serviço</h1>
                <form action="/petiti/api/cadastrar-produto-servico" method="post" enctype="multipart/form-data">

                    <div class="parteInputFoto">

                        <div class="fotoSelecionarImagem">
                            <img style="width: 250px" id="selectFotoIlustracao" src="./assets/images/selectFotoIlustracao.png">
                        </div>

                        <span class="textArrasteFoto">Arraste uma foto do seu produto/serviço</span>

                        <label class="btn inputButtonEstilo">
                            <input style="display: none;" onchange="previewFile()" type="file" id="flFotoEmpresa">
                            <span>Escolha no computador</span>
                        </label>
                    </div>

                    <input type="hidden" name="baseFotoEmpresa" id="baseFotoEmpresa">

                    <span id="divisaoPartes"></span>

                    <div class="parteInputInfos">

                        <span style="font-size: 24;">Escolha o tipo</span>
                        <select name="tipoCad" id="tipoCad">
                            <option value="produto" id="optionTipoCad">Produto</option>
                            <option value="servico" id="optionTipoCad">Servico</option>
                        </select>

                        <span style="font-size: 24;padding-top: 0.7rem">Nome</span>
                        <input required autocomplete="off" type="text" name="titulo" id="titulo" placeholder="Ex: bolinha de borracha ou tosa">

                        <span style="font-size: 24;padding-top: 0.7rem">Valor</span>
                        <input required autocomplete="off" type="number" name="valor" id="valor" placeholder="R$">

                        <span style="font-size: 24;padding-top: 0.7rem">Descrição</span>
                        <textarea required autocomplete="off" name="descricao" id="descricao" placeholder="Ex: É possível escolher na cor rosa, verde e azul e seu tamanho é de 5cm"></textarea>

                    </div>

                    <div class="parteInputSubmit">
                        <label class="btn inputButtonEstilo">
                            <input type="submit" value="">
                            <span>Cadastrar</span>
                        </label>
                    </div>

                </form>
            </div>
        </section>

        <section>
            <div id="modal-seguidores" class="modal">

            </div>
        </section>

        <section>
            <div id="modal-seguindo" class="modal">

            </div>
        </section>

    </main>

</body>

</html>




<!-- <button class="seguir" value="1">seguir</button> -->