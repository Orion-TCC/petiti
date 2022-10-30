<?php
@session_start();
require('../../api/classes/curtidaPublicacao.php');
require('../../api/classes/Usuario.php');

$curtidaPub = new curtidaPublicacao();
date_default_timezone_set('America/Sao_Paulo');


include_once("../../sentinela.php");
$idUsuarioCurtida = $_SESSION['id'];

$url = "http://localhost/petiti/api/publicacoes/usuario/" . $_SESSION['id'];

$json = file_get_contents($url);
$dados = (array)json_decode($json, true);
$contagem = count($dados['publicacoes']);

$urlCurtidas = "http://localhost/petiti/api/publicacoes/curtidas/" . $_SESSION['id'];

$jsonCurtidas = file_get_contents($urlCurtidas);
$dadosCurtidas = (array)json_decode($jsonCurtidas, true);
$contagemCurtidas = count($dadosCurtidas['publicacoes']);
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
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

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

    <nav class="feed">
        <div class="container">
            <h2 class="logo">
                <img src="./assets/images/logo_principal.svg">
            </h2>
            <div class="caixa-de-busca">
                <i class="uil uil-search"></i>
                <input type="search" placeholder="Pesquisar">
            </div>

            <div class="opcoes">
                <label for="abrir-opcoes"><i class="uil uil-setting"></i></label>
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
                    <a href="/petiti/feed" class="menu-item">
                        <span><i class="uil uil-house-user"></i> </span>
                        <h3>Home</h3>
                    </a>

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-heart-break"></i></span>
                        <h3>Animais perdidos</h3>
                    </a>

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>
                        <h3>Animais em doação</h3>
                    </a>


                    <a href="#" class="menu-item">
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

                    <a href="#" class="menu-item">
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
                                    <h2><?php echo $_SESSION['login']; ?></h2>
                                    <a rel="modal:open" href="#modal-editar-perfil" class="btn btn-primary">Editar perfil</a>
                                </div>




                                <div class="modal" id="modal-editar-perfil">
                                    
                                    <form class="flex-col" action="/petiti/api/editar-perfil" method="post">
                                        
                                            <div class="editPerfilHeader">
                                                <div class="flex-row" >
                                                    <a style="display: block !important;" href="#close-modal" rel="modal:close"><i class="uil uil-multiply"></i></i></a>
                                                    <h2>Editar perfil</h2>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            
                                            </div>

                                    <div class="editarPerfilForm">

                                        <div class="flex-row">

                                            <img class="fotoDePerfil" id="preview"  src="<?php echo $_SESSION['foto'] ?>">

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
                                            <h4 class="text-muted">0/200</h3>
                                        </div>

                                    </div>

                                    </form>
                                </div>

                                <div id="modal-recortar-foto-perfil" class="modal">
                                    <div class="modalInner">
                                        <span class="subTituloForm">Redimensione sua imagem!</span>
                                        <a class="formInputFoto">
                                            <span id="continuar-crop-foto-perfil" style="padding-block: 10px; padding-inline: 87px;">Confirmar</span>
                                        </a>
                                        <div id="upload-demo"></div>
                                    </div>
                                </div>

                                <div class="infoHolder meio">
                                    <h3> <?php echo $contagem ?> <span class="text-muted"> postagens </span></h3>
                                    <h3> 0 <span class="text-muted">seguidores</span></h3>
                                    <h3> 0 <span class="text-muted">Seguindo</span></h3>
                                </div>

                                <div class="infoHolder baixo">
                                    <div style="width: 15rem; display: flex; align-items: center;">
                                          <i class="uil uil-map-marker"></i> <h4><?php echo $_SESSION['local'] ?></h4>
                                    </div>

                                    <div style="width: 15rem; display: flex; align-items: center;">
                                           <i class="uil uil-link-alt"></i> <a href="http://<?php echo $_SESSION['site'] ?>"><?php echo $_SESSION['site'] ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="userBaixo">

                            <div class="subUserBaixo">
                                <div style="width: fit-content; max-width: 25rem; display: flex; align-items: center;">
                                     <h2><?php echo $_SESSION['nome']; ?></h2>
                                </div>

                                <h4 class="text-muted">(Sou dono(a) do @/nomedopet)</h4>
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
                    </div>
                    <!-- fim da parte de informacao do usuario -->

                    <div class="tabs">

                        <div class="userTabs ">
                            <button class="userTabOption userTabOption--ativo " data-for-tab="1">Postagens</button>
                            <button class="userTabOption" data-for-tab="2">Marcaçoes</button>
                            <button class="userTabOption" data-for-tab="3">Curtidas</button>
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

                        <div class="tabs_content marcacoes" data-tab="2">
                            <div class="previewPostImage">
                                <img src="<?php echo $foto ?>" alt="">
                            </div>

                            <div class="aviso">
                                <h3>Parece que ninguém te marcou em um post ainda...</h3>
                            </div>
                        </div>

                        <div class="tabs_content curtidas" data-tab="3">

                            <?php

                            if ($contagemCurtidas < 1) { ?>
                            
                                <div class="aviso">
                                    <h3>Ainda nenhuma postagem curtida. Va para sua <a href="feed">Home</a> ou <a href="#">Para você</a> e curta alguma coisa!</h3>
                                </div>

                                <?php } else {

                                for ($i = 0; $i < $contagemCurtidas; $i++) {
                                    $fotoCurtidas = $dadosCurtidas['publicacoes'][$i]['caminhoFoto'];
                                ?>
                                    <div class="previewPostImage">
                                        <img src="<?php echo $fotoCurtidas ?>" alt="">
                                    </div>
                            <?php }
                            } ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- fim do meio -->

        </div>
    </main>

</body>

</html>




<!-- <button class="seguir" value="1">seguir</button> -->