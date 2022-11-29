<?php
@session_start();
require_once('../../api/classes/curtidaPublicacao.php');
require_once('../../api/classes/FotoUsuario.php');
require_once('../../api/classes/Usuario.php');
require_once('../../api/classes/UsuarioSeguidor.php');
require_once('../../api/classes/Categoria.php');
require_once('../../api/classes/CategoriaSeguida.php');
include_once("../../sentinela.php");
$categoriaSeguida = new categoriaSeguida();
$curtidaPub = new curtidaPublicacao();
date_default_timezone_set('America/Sao_Paulo');
$fotousuario = new FotoUsuario();
$idUsuarioCurtida = $_SESSION['id'];
$id = $_SESSION['id'];
$urlPets = "http://localhost/petiti/api/usuario/$id/pets";

$jsonPets = file_get_contents($urlPets);

$dadosPets = (array) json_decode($jsonPets, true);

$contagemPets = count($dadosPets['pets']);
$categoria = new Categoria;

$usuarioSeguidor = new UsuarioSeguidor();

$usuario = new Usuario();

$categoria = new Categoria;
$listaCategorias  = $categoria->listarCategoriasPopulares();
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
    <link rel="stylesheet" href="/petiti/assets/css/paraVoce-style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - Para você</title>
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
                <img src="/petiti/assets/images/logo_principal.svg">
            </h2>

            <div class="caixa-de-busca">
                <i class="uil uil-search"></i>
                <input class="inputSearch" autocomplete="off" id="inputSearch" type="search" placeholder="Pesquisar">
                <div id="resultadoPesquisa" class="resultadoPesquisa">
                </div>
            </div>

            <?php

            if (isset($_COOKIE['denuncia'])) {
                echo $_COOKIE['denuncia'];
            }

            ?>

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

                    <a href="prodServ" class="menu-item">
                        <span><i class="uil uil-shopping-bag"></i> </span>
                        <h3>Produtos e Serviços</h3>
                    </a>

                    <a href="paraVoce" class="menu-item ativo">
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

                <span>Explore a pet iti!</span>

                <div class="paraVoceDisc">
                    <div class="h4Holder">
                        <h4>
                            A <span class="hrefCor">“ Para Você “</span> é praticamente um feed porém com todos os posts da nossa rede social. Assim, você será capaz de explorar e encontrar novos perfis, posts inéditos e muito mais!
                        </h4>

                        <h4>
                            Outra funcionalidade é a de <span class="hrefCor">seguir categorias</span>, para que a sua “Para Você” mostre mais posts de acordo com o seu gosto, logo, exibindo de forma aleatória postagens alheias e com categorias que você segue.
                        </h4>
                    </div>

                    <img src="assets/images/lhamaAmigo.svg" alt="">
                </div>


                <div class="paraVoceDisc paraVoceDisc2">

                    <div class="h4Holder">
                        <h4>
                            É possível seguir uma categoria apenas clicando nela, na qual irá aparecer um pequeno detalhe roxo. E caso você não queira mais seguir uma categoria específica, é só clicar de novo nela.
                        </h4>

                        <img src="assets/images/previewCategorias.svg" alt="">
                    </div>

                    <div class="badges">
                        <p class='badge-categoria' id=''> Cachorro</p>
                        <p class='badge-categoria seguida' id=''>Esquizofrenico</p>
                        <p class='badge-categoria seguida' id=''>Esquizofrenico</p>
                        <p class='badge-categoria' id=''> Cachorro</p>
                        <p class='badge-categoria' id=''> Cachorro</p>
                        <p class='badge-categoria seguida' id=''>Esquizofrenico</p>
                        <p class='badge-categoria seguida' id=''>Esquizofrenico</p>
                        <p class='badge-categoria' id=''> Cachorro</p>
                        <p class='badge-categoria' id=''> Cachorro</p>
                        <p class='badge-categoria seguida' id=''>Esquizofrenico</p>
                        <p class='badge-categoria seguida' id=''>Esquizofrenico</p>
                        <p class='badge-categoria' id=''> Cachorro</p>
                    </div>

                </div>

                <!-- fim da parte de ad -->

                <div class="feeds">
                    <?php
                    $contadorPostagem = 0;
                    $id = $_SESSION['id'];
                    $url = "http://localhost/petiti/api/publicacoes/paraVoce/$id";

                    $json = file_get_contents($url);
                    $dados = (array)json_decode($json, true);
                    $contagem = count($dados['publicacoes']);
                    if ($contagem == 0) {
                    ?>
                        <div class="contagemZero">
                            <div class="semPublicacaoes">
                                <img src="/petiti/assets/images/semPost.svg" id="svgSemPost">
                                <p class="textoSemPublicacoes">Parece que não tem nada por aqui... Faça um post ou siga alguém para ver o que eles estão postando!</p>
                                <?php

                                ?>
                            </div>
                        </div>

                    <?php }
                    for ($i = 0; $i < $contagem; $i++) {

                        $id =  $dados['publicacoes'][$i]['idPublicacao'];

                        $idUsuarioPub = $dados['publicacoes'][$i]['idUsuario'];

                        $urlComentarios = "http://localhost/petiti/api/comentarios-post/" . $id;

                        $jsonComentarios = file_get_contents($urlComentarios);

                        $dadosComentarios = (array)json_decode($jsonComentarios, true);
                        $contagemComentarios = count($dadosComentarios['comentarios']);
                        $nome = $dados['publicacoes'][$i]['nomeUsuario'];
                        $login = $dados['publicacoes'][$i]['loginUsuario'];
                        $foto = $dados['publicacoes'][$i]['caminhoFotoPublicacao'];
                        $idUsuario = $dados['publicacoes'][$i]['idUsuario'];
                        $data = $dados['publicacoes'][$i]['dataPublicacao'];
                        $texto = $dados['publicacoes'][$i]['textoPublicacao'];
                        $itimalias = $dados['publicacoes'][$i]['itimalias'];
                        $fotoUsuario = $fotousuario->exibirFotoUsuario($idUsuario);
                        $local =  $dados['publicacoes'][$i]['localPub'];
                        $hoje = new DateTime();
                        $dataPost = new DateTime($data);
                        $intervalo = $hoje->diff($dataPost);
                        $diferencaAnos = $intervalo->format('%y');
                        $diferencaMeses = $intervalo->format('%m');
                        $diferencaDias = $intervalo->format('%a');
                        $diferencaHoras = $intervalo->format('%h');
                        $diferencaMinutos = $intervalo->format('%i');

                        $urlCategorias = "http://localhost/petiti/api/categorias-post/" . $id;

                        $jsonCategorias = file_get_contents($urlCategorias);

                        $dadosCategorias = (array)json_decode($jsonCategorias, true);

                        $contagemCategorias = count($dadosCategorias);

                        if ($diferencaAnos == 0) {
                            if ($diferencaMeses == 0) {
                                if ($diferencaDias == 0) {
                                    if ($diferencaHoras == 0) {
                                        $diferencaFinal = $diferencaMinutos . " minutos";
                                    } else {
                                        $diferencaFinal = $diferencaHoras . " horas";
                                    }
                                } else {
                                    $diferencaFinal = $diferencaDias . " dias";
                                }
                            } else {
                                $diferencaFinal = $diferencaMeses . " meses";
                            }
                        } else {
                            $diferencaFinal = $diferencaAnos . " anos";
                        }
                    ?>
                        <div class="feed">
                            <div class="head">
                                <div class="usuario">
                                    <div class="fotoDePerfil">
                                        <a href="/petiti/<?php echo $login ?>"><img src="<?php echo $fotoUsuario; ?>" alt=""></a>
                                    </div>
                                    <div class="info">
                                        <h3><a href="/petiti/<?php echo $login ?>"> <?php echo $nome ?></a></h3>
                                        <small><?php echo $local ?> há <?php echo $diferencaFinal ?></small>
                                    </div>
                                </div>



                                <span class="edit" id="<?php echo $id; ?>">

                                    <div class="editButton">
                                        <div class="menuPostHover"></div>
                                        <i class="uil uil-ellipsis-v"></i>
                                    </div>

                                    <div class="menuPost" id="menuPost">
                                        <ul id="opcoesPost <?php echo $id; ?>" class="opcoesPost close">
                                            <?php if ($login != $_SESSION['login']) { ?>
                                                <li><i class="fa-sharp fa-solid fa-user-minus"></i><span class="deixaSeguir">Deixar de seguir</span></li>
                                                <a href="#modal-denuncia" rel="modal:open">
                                                    <div id="<?php echo $id; ?>" class="postDenunciado">
                                                        <div id="<?php echo $idUsuarioPub; ?>" class="denunciaPost">
                                                            <li id="denunciarCor">

                                                                <i class="fa-solid fa-circle-exclamation"></i>
                                                                <span>Denunciar</span>

                                                            </li>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php } else { ?>
                                                <li class="li-EditarPost">
                                                    <div style="display: flex; align-items: center;">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        <span class="editarPost"> Editar Post </span>
                                                    </div>
                                                </li>
                                                <li class="li-ExcluirPost">
                                                    <div style="display: flex; align-items: center;">

                                                        <i style="color: #DB310C;" class="fa-solid fa-trash"></i>
                                                        <span class="excluirPost">Excluir Post</span>

                                                        <div id="modal-exclui-post" class="modal certeza-excluir">
                                                            <div class="innerCerteza-excluir">

                                                                <h2 style="font-family: 'Raleway Extra Bold';">Excluir post?</h2>
                                                                <h4>Após excluir, essa ação não poderá ser desfeita, e o post será removido do seu perfil, da timeline de outras contas e dos resultados de busca.</h4>

                                                                <div class="opcoes-certeza-excluir">
                                                                    <a href="/petiti/api/publicacao/delete/<?php echo $id; ?>"><button class="btn btn-primary excluir">Excluir</button></a>
                                                                    <a rel="modal:close"><button class="btn btn-primary cancelar">Cancelar</button></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </li>
                                                </a>
                                            <?php } ?>
                                        </ul>
                                    </div>

                                </span>



                            </div>

                            <div class="imagemPost">
                                <img src="<?php echo $foto ?>" alt="">
                            </div>

                            <div class="botoes">
                                <div class="botoesDeInteracao">


                                    <?php
                                    $verificaCurtida = $curtidaPub->verificarCurtida($id, $idUsuarioCurtida);
                                    if ($verificaCurtida['boolean'] == false) { ?>
                                        <input checked class="curtir" value="<?php echo $id ?>" type="checkbox">
                                        <!-- curtido -->
                                    <?php } else { ?>

                                        <input class="curtir" value="<?php echo $id ?>" type="checkbox">
                                        <!-- nao curtido  -->
                                    <?php }
                                    ?>

                                    <a href="#modal-post" rel="modal:open"><button class="abrirComentarios " value="<?php echo $id ?>"></button></a>

                                    <button class="mensagem"></button>

                                </div>
                            </div>

                            <div class="curtidoPor">

                                <?php
                                $verificaCurtida = $curtidaPub->verificarCurtida($id, $idUsuarioCurtida);
                                if ($verificaCurtida['boolean'] == false) { ?>
                                    <span> <b id="itimalias<?php echo $id ?>"> <?php echo $itimalias ?></b></b> itimalias</span>
                                    <!-- curtido -->
                                <?php } else { ?>
                                    <span><b><b id="itimalias<?php echo $id ?>"> <?php echo $itimalias ?></b></b> itimalias</span>
                                    <!-- nao curtido  -->
                                <?php }
                                ?>
                            </div>

                            <div class="caption">
                                <span class="text-bold"> <?php echo $login; ?></span> <span class="text-muted"><?php echo $texto ?></span>
                            </div>


                            <div class="badges">
                                <?php
                                for ($j = 0; $j < $contagemCategorias; $j++) {
                                    $idCategoriaAtual = $categoria->pesquisarCategoria($dadosCategorias[$j]['categoria']);
                                    $verificaCategoriaSeguida = $categoriaSeguida->verificarSeguida($_SESSION['id'], $idCategoriaAtual);
                                    if ($verificaCategoriaSeguida['boolean'] == true) {
                                        echo ("<p class='badge-categoria' id='$idCategoriaAtual'> " . $dadosCategorias[$j]['categoria'] . "</p>");
                                    } else {
                                        echo ("<p class='badge-categoria seguida' id='$idCategoriaAtual'> " . $dadosCategorias[$j]['categoria'] . "</p>");
                                    }
                                }
                                ?>
                            </div>

                            <div id="comentarios<?php echo $id ?>" class="comentarios">

                                <?php if ($contagemComentarios > 0) {
                                    for ($c = 0; $c  < $contagemComentarios; $c++) { ?>
                                        <?php
                                        $idComentarioAtual = $dadosComentarios['comentarios'][$c]['idComentario']
                                        ?>

                                        <div style='display: flex; flex-direction: row; align-items: center; position: relative; justify-content: space-between;'>

                                            <div class="flex-row" style="align-items: center; gap: 0.6rem;">
                                                <h2 style='font-weight: 900 !important; align-self: start;'>
                                                    <?php echo $dadosComentarios['comentarios'][$c]['loginUsuario'] ?>
                                                </h2>

                                                <h3 style='color: rgba(86, 86, 86, 1); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 30rem;'>
                                                    <?php echo $dadosComentarios['comentarios'][$c]['textoComentario'] ?>
                                                </h3>
                                            </div>

                                            <div class="optionsDenunciaComent" id="<?php echo "$idComentarioAtual"; ?>">
                                                <i class="uil uil-ellipsis-h commentEllipsis"></i>
                                            </div>

                                            <div class="menuComent" id="menuComent<?php echo "$idComentarioAtual"; ?>" style="display: none;">

                                                <a href="#modal-denuncia-comentario" rel="modal:open">
                                                    <div style="color: #DB310C;" id="denunciarCor<?php echo "$idComentarioAtual"; ?>" name="<?php echo $dadosComentarios['comentarios'][$c]['idComentador']; ?>" class="menuComentElement">
                                                        <i class="fa-solid fa-circle-exclamation"></i>
                                                        <span>Denunciar</span>
                                                    </div>
                                                </a>

                                                <?php
                                                if (($_SESSION['login'] == $login) || ($dadosComentarios['comentarios'][$c]['loginUsuario'] == $_SESSION['login'])) { ?>
                                                    <a style="color:black;" href="/petiti/api/comentario/delete/<?php echo $idComentarioAtual; ?>">
                                                        <div class="menuComentElement">
                                                            <i style="color: #DB310C;" class="fa-solid fa-trash"></i>
                                                            <span>Excluir</span>
                                                        </div>
                                                    </a>
                                                <?php }
                                                ?>


                                            </div>


                                        </div>

                                    <?php
                                        if ($c == 2) {
                                            $c = $contagemComentarios - 1;
                                        }
                                    }  ?>
                                <?php
                                } ?>
                            </div>

                            <a href="#modal-post" rel="modal:open"><button class="abrirComentarios ahrefVermais" value="<?php echo $id ?>"> Ver mais...</button></a>

                            <div class="commentArea" id="<?php echo $id; ?>">
                                <i class="uil uil-heart"></i>
                                <textarea oninput="auto_grow(this)" cols="30" rows="10" placeholder="Adicione um comentário!" maxlength="200" name="txtComentar<?php echo $id ?>" id="txtComentar<?php echo $id ?>" class="TAComentario<?php echo $id; ?>"></textarea>

                                <button value="<?php echo $id ?>" class="comentar" value="">
                                    <i class="uil uil-message"></i>
                                </button>
                            </div>

                            <div class="contagemChar">

                                <div class="flex-row" style="width: 100%; justify-content: end;">
                                    <input type="text" class="contagemCharInput" value="0" id="contagemCharInput<?php echo $id; ?>" disabled>
                                    <span>/200</span>
                                </div>
                            </div>

                        </div>
                    <?php $contadorPostagem++;
                    }
                    ?>
                </div>
            </div>
            <!-- fim do meio -->


            <div class="ladoDireito">
                <!-- posts de pets perdidos -->
                <div class="whiteBoxHolder postsPerdidosHolder">

                    <div class="heading tituloPetsPerdidos">
                        <h4>Ajude alguém a encontrar seu pet</h4>
                    </div>
                    <?php
                    $contadorPostagemPerdidos = 0;
                    $urlPerdidos = "http://localhost/petiti/api/publicacoes/perdidos";
                    $jsonPerdidos = file_get_contents($urlPerdidos);
                    $dadosPerdidos = (array)json_decode($jsonPerdidos, true);
                    $contagemPerdidos = count($dadosPerdidos['publicacoes']);
                    if ($contagemPerdidos > 0) {
                        for ($pp = 0; $pp < $contagemPerdidos and $pp <= 2; $pp++) {
                            $fotoPerdido = $dadosPerdidos['publicacoes'][$pp]['caminhoFoto'];
                            $dataPerdido = $dadosPerdidos['publicacoes'][$pp]['data'];
                            $localPerdido =  $dadosPerdidos['publicacoes'][$pp]['local'];
                            $textoPerdido = $dadosPerdidos['publicacoes'][$pp]['texto'];
                            $hoje = new DateTime();
                            $dataPost = new DateTime($dataPerdido);
                            $intervalo = $hoje->diff($dataPost);
                            $diferencaAnos = $intervalo->format('%y');
                            $diferencaMeses = $intervalo->format('%m');
                            $diferencaDias = $intervalo->format('%a');
                            $diferencaHoras = $intervalo->format('%h');
                            $diferencaMinutos = $intervalo->format('%i');

                            if ($diferencaAnos == 0) {
                                if ($diferencaMeses == 0) {
                                    if ($diferencaDias == 0) {
                                        if ($diferencaHoras == 0) {
                                            $diferencaFinal = $diferencaMinutos . " minutos";
                                        } else {
                                            $diferencaFinal = $diferencaHoras . " horas";
                                        }
                                    } else {
                                        $diferencaFinal = $diferencaDias . " dias";
                                    }
                                } else {
                                    $diferencaFinal = $diferencaMeses . " meses";
                                }
                            } else {
                                $diferencaFinal = $diferencaAnos . " anos";
                            }
                    ?>
                            <div class="postsPerdidos">

                                <div class="fotoDePerfil">
                                    <img src="<?php echo $fotoPerdido ?>" alt="">
                                </div>


                                <div class="infoPostPerdidos">
                                    <h4><?php echo $textoPerdido ?></h4>
                                    <h5 class="text-Muted">Há <span><?php echo $diferencaFinal ?></span> - <span>Localização: <?php echo $localPerdido ?></span></h5>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <h4 style="margin-top: 5px;" class="text-muted">Não tem nenhuma postagem com as categorias do feed exclusivo de animais perdidos...</h4>

                    <?php }
                    ?>
                </div>
                <!-- fim de posts de pets perdidos -->

                <div class="categoriasEmAlta">
                    <div class="whiteBoxHolder ">
                        <div class="heading">
                            <h4>Categorias em alta</h4>
                        </div>

                        <div class="categoriasAltaGrid">
                            <?php
                            $contategmCategoriasPopulares = count($listaCategorias);
                            for ($a = 0; $a < $contategmCategoriasPopulares; $a++) { ?>
                                <?php if ($listaCategorias[$a]['categoria'] != "") { ?>
                                    <div class="categorias">
                                        <div class="Lugar">
                                            <div class="fotoDePerfil">
                                                <img src="/petiti/views/assets/img/position<?php echo ($a + 1); ?>.svg" alt="">
                                            </div>
                                            <div class="infoCategoria">
                                                <h4>
                                                    <?php echo $listaCategorias[$a]['categoria']; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                            <?php }
                            } ?>

                        </div>
                    </div>
                </div>
                <!-- fim das categorias em alta -->


                <div class="sugestoes">
                    <h4>Sugestões para você</h4>
                    <?php

                    $sugestoes = $usuario->sugestoesSeguidores($_SESSION['id']);
                    $contagemSugestoes = count($sugestoes);
                    if ($contagemSugestoes > 0) {


                        foreach ($sugestoes as $sugestao) {
                            $idUsuarioSugerido = $sugestao['idUsuario'];
                            $fotoUsuarioSugestao = $fotousuario->exibirFotoUsuario($idUsuarioSugerido);
                            $verificarSeguidor = $usuarioSeguidor->verificarSeguidor($idUsuarioSugerido, $_SESSION['id']);
                            if ($verificarSeguidor['boolean'] == true) { ?>
                                <div class="whiteBoxHolder">
                                    <a href="/petiti/<?php echo $sugestao['loginUsuario'] ?>">
                                        <div class="flex-row">
                                            <div class="fotoDePerfil">
                                                <img src="<?php echo $fotoUsuarioSugestao ?>" alt="">
                                            </div>

                                            <div class="infoSugestoes">
                                                <h4 style="color: black; margin-bottom: 0.2rem"><?php echo $sugestao['nomeUsuario'] ?></h4>
                                                <h5 class="text-muted">@<?php echo $sugestao['loginUsuario'] ?></h5>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                    $verificarSeguidor = $usuarioSeguidor->verificarSeguidor($idUsuarioSugerido, $id);
                                    if ($verificarSeguidor['boolean'] == true) {
                                        $jsSeguidor = "true";
                                    } else {
                                        $jsSeguidor = "false";
                                    } ?>

                                    <?php if ($verificarSeguidor['boolean'] == true) { ?>
                                        <input id="jsSeguidor" value="<?php echo $jsSeguidor ?>" type="hidden">

                                        <button value="<?php echo  $idUsuarioSugerido ?>" class="seguirNotif botaoUsuario<?php echo  $idUsuarioSugerido ?> btn btn-primary">Seguir</button>
                                    <?php } else { ?>
                                        <button value="<?php echo  $idUsuarioSugerido ?>" class="seguirNotif botaoUsuario<?php echo  $idUsuarioSugerido ?> btn btn-secundary">Seguindo</button>
                                    <?php } ?>
                                </div>
                        <?php }
                        }
                    } else { ?>
                        <h4 style="margin-top: 5px;" class="text-muted">As sugestões aparecem de acordo com os seguidores das contas que você segue, mas no momento você não segue ninguém...</h4>
                    <?php } ?>

                </div>
            </div>
        </div>



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

                    <div style="display: flex; flex-direction: row; justify-content: end;">
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

            <div href="#modal-denuncia" rel="modal:open">

                <div id="modal-denuncia" class="modal denuncia">

                    <form class="formDenuncia" method="POST" action="/petiti/api/denunciaPublicacao">

                        <input type="hidden" id="idPost" name="idPost" value="">

                        <input type="hidden" id="idUsuarioPub" name="idUsuarioPub" value="">

                        <h1 style="color:black;">Denunciar post</h1>

                        <h4 style="color:black;" class="text-muted">Você está denunciando o post desse usuário. Conte a causa dessa denúncia e nossa equipe irá te responder o mais rápido possível. </h4>

                        <div style="width: 99%;">
                            <h4>Causa:</h4>
                            <textarea name="txtDenuncia" id="txtDenuncia" maxlength="200"></textarea>
                        </div>
                        <div class="botoesDenuncia">
                            <input class="btn btn-primary" type="submit" value="Denunciar">
                            <a rel="modal:close"><button class="btn btn-primary cancelar">Cancelar</button></a>
                        </div>
                    </form>

                </div>
            </div>

        </section>


        <section>
            <div id="modal-post" class="modal post">

            </div>
        </section>


        <section>
            <div class="modal denuncia" id="modal-denuncia-comentario">
                <div class="modal-denuncia-comentario-elements">
                    <div class="titulo-denuncia-comentario">
                        <h2>Denunciar Comentário</h2>
                    </div>
                    <div class="form-denuncia-comentario">
                        <form action="/petiti/api/denunciaComentario" method="post">
                            <input type="hidden" id="txtDenunciado" name="txtDenunciado" value="">
                            <input type="hidden" name="txtidComentario" id="txtidComentario" value="">
                            <input type="text" required placeholder="Motivo da denuncia: " name="txtMotivoDenunciaComentario" id="txtMotivoDenunciaComentario">
                            <input type="submit" value="Denunciar">
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- fim Modals -->

    </main>

</body>

</html>