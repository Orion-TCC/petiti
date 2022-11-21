<?php
@session_start();
require('../../api/classes/curtidaPublicacao.php');
require('../../api/classes/Usuario.php');
@session_start();
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

$idPetEscolhido = $_SESSION['pet-escolhido'];
$urlPerfil = "http://localhost/petiti/api/pet/$idPetEscolhido";
$jsonPerfil = file_get_contents($urlPerfil);

$dadosPerfil = json_decode($jsonPerfil);
$idade = $dadosPerfil[0]->idadePet;
$nome = $dadosPerfil[0]->nomePet;
$raca = $dadosPerfil[0]->racaPet;
$usuarioPet = $dadosPerfil[0]->usuarioPet;
$especie = $dadosPerfil[0]->especiePet;
$foto = $dadosPerfil[0]->caminhoFotoPet;

$id = $_SESSION['id'];
$urlPets = "http://localhost/petiti/api/usuario/$id/pets";

$jsonPets = file_get_contents($urlPets);

$dadosPets = (array) json_decode($jsonPets, true);

$contagemPets = count($dadosPets['pets']);

$conexao = Conexao::conexao();


$query = "SELECT COUNT(idPetSeguidor) as qtdSeguidores FROM tbpetseguidor WHERE idPetSeguido = $idPetEscolhido";
$resultado = $conexao->query($query);
$lista = $resultado->fetchAll();
$qtdSeguidores = $lista[0]['qtdSeguidores'];
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
    <script src="/petiti/assets/js/jquery-scripts.js"></script>
    <script src="/petiti/views/assets/js/funcs.js"></script>
</head>

<body class="feed perfilUsuario">

    <nav class="feed">
        <div class="container">

            <div class="popupOptions" id="popup">

                <div class="flex-col">

                    <div class="flex-row">
                        <div class="fotoDePerfil">
                            <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                        </div>
                        <h3><a href="tutor-perfil"><?php echo $_SESSION['nome']; ?></a></h3>
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
                <a href="feed"><img src="/petiti/assets/images/logo_principal.svg"></a>
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

            <script>

            </script>

            <div class="opcoes" id="opcoes">

                <div id="labelAO"><i id="settings-icon" class="uil uil-setting"></i></div>

                <div class="fotoDePerfil" id="fotoDePerfil">
                    <img src="<?php echo $_SESSION['foto']; ?>" alt="" id="fotoDePerfilOpcoes">
                </div>

            </div>

        </div>
    </nav>

    <main class="feed">
        <div class="container">

            <!-- LADO ESQUERDO -->
            <div class="ladoEsquerdo">

                <a href="/petiti/decidir-perfil" class="perfilAtivo">
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
                        <h3>Animais Perdidos</h3>
                    </a>

                    <a href="animaisEmAdocao" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>
                        <h3>Animais para Adoção</h3>
                    </a>


                    <a href="notificacoes" class="menu-item">
                        <span class="mostrarNotificacoes" style="position: relative;">
                            <i class="uil uil-bell notificacao"></i>

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
                                <img src="<?php echo $foto ?>" alt=""> <!--  foto do pet  -->
                            </div>

                            <div class="userInfo">

                                <div class="infoHolder topo">
                                    <div class="flex-row" style="gap: 2rem;">
                                        <h2><?php echo $usuarioPet; ?></h2>
                                        <a rel="modal:open" href="#modal-editar-perfil" class="btn btn-primary">Editar perfil</a>
                                    </div>
                                </div>




                                <div class="modal" id="modal-editar-perfil">

                                    <form class="flex-col" action="/petiti/api/editar-perfil-pet/<?php echo $idPetEscolhido ?>" method="post">

                                        <div class="editPerfilHeader">
                                            <div class="flex-row">
                                                <a style="display: block !important;" href="#close-modal" rel="modal:close"><i class="uil uil-multiply"></i></i></a>
                                                <h2>Editar perfil</h2>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Salvar</button>

                                        </div>

                                        <div class="editarPerfilForm">

                                            <div class="flex-row">
                                                <img class="fotoDePerfil" id="preview" src="<?php echo $foto ?>">

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
                                                <input placeholder="Nome" value="<?php echo $nome ?>" type="text" name="txtNome" id="txtNome" autocomplete="off" maxlength="40">
                                            </div>

                                            <div class="flex-col">
                                                <label class="text-bold" for="">Raça</label>
                                                <input value="<?php echo $raca ?>" placeholder="Raça" type="text" name="txtRaca" id="txtRaca" autocomplete="off" maxlength="40">
                                            </div>

                                            <div class="flex-col">
                                                <label class="text-bold" for="">Especie</label>
                                                <input value="<?php echo $especie ?>" placeholder="Espécie" type="text" name="txtEspecie" id="txtEspecie" autocomplete="off" maxlength="40">
                                            </div>

                                            <div class="flex-col">
                                                <label class="text-bold" for="">Idade</label>
                                                <input value="<?php echo $idade ?>" placeholder="Idade" type="text" name="txtIdade" id="txtIdade" autocomplete="off" maxlength="40">
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
                                    <h3> <span id="seguidores"> <?php echo $qtdSeguidores ?> </span> <span class="text-muted">seguidores</span></h3>
                                </div>

                                <div class="infoHolder baixo">
                                    <div style="width: 15rem; display: flex; align-items: center;">
                                        <i class="icon enciclopedia"></i>
                                        <h4><?php echo $raca ?></h4>
                                    </div>

                                    <div style="width: 15rem; display: flex; align-items: center;">
                                        <i class="icon boloDeAniversario"></i>
                                        <h4><?php echo $idade ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="userBaixo">

                            <div class="subUserBaixo">
                                <div style="width: fit-content; max-width: 25rem; display: flex; align-items: center;">
                                    <h2><?php echo $nome ?></h2>
                                </div>

                                <h4 class="text-muted">(Meu dono(a) é <a href="/petiti/<?php echo $_SESSION['login'] ?>">@<?php echo $_SESSION['login'] ?></a>)</h4>
                            </div>


                        </div>
                    </div>
                    <!-- fim da parte de informacao do usuario -->

                    <div class="tabs">

                        <div class="userTabs ">
                            <button class="userTabOption userTabOption--ativo" data-for-tab="1">Postagens</button>
                            <button class="userTabOption" data-for-tab="2">Marcações</button>
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

                            <div class="aviso">
                                <h3>Parece que ninguém te marcou em um post ainda...</h3>
                            </div>
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


    </main>

</body>

</html>




<!-- <button class="seguir" value="1">seguir</button> -->