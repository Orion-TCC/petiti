<?php
@session_start();
require_once('../../api/classes/curtidaPublicacao.php');
require_once('../../api/classes/FotoUsuario.php');
require_once('../../api/classes/Notificacao.php');
require_once('../../api/classes/UsuarioSeguidor.php');

include_once("../../sentinela.php");
$notificacao = new Notificacao();

$conexao = Conexao::conexao();
$fotoUsuario = new FotoUsuario();
$curtidaPub = new curtidaPublicacao();
$usuarioSeguidor  = new UsuarioSeguidor();
date_default_timezone_set('America/Sao_Paulo');

$idUsuarioCurtida = $_SESSION['id'];
$id = $_SESSION['id'];
$urlPets = "http://localhost/petiti/api/usuario/$id/pets";

$jsonPets = file_get_contents($urlPets);

$dadosPets = (array) json_decode($jsonPets, true);

$contagemPets = count($dadosPets['pets']);


$listaNotif = $notificacao->listarNotif($id);

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
    <link rel="stylesheet" href="/petiti/assets/css/notificacoes-style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - Notificações</title>
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
                <input type="search" placeholder="Pesquisar">
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
                        <h3>Animais perdidos</h3>
                    </a>

                    <a href="animaisEmAdocao" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>
                        <h3>Animais para adoção</h3>
                    </a>


                    <a href="notificacoes" class="menu-item ativo">
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


            <div class="Meio">
                <span class="adTitulo">Notificações</span>
                <div class="abanotificacoes">
                    <?php foreach ($listaNotif as $notificacao) {
                        $hoje = new DateTime();
                        $dataPost = new DateTime($notificacao['dataNotificacao']);
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


                        <?php if ($notificacao['tipoNotificacao'] == "Seguir") {
                            $query = "SELECT loginUsuario, tbusuario.idUsuario FROM tbusuario INNER JOIN 
                            tbusuarioseguidor ON tbusuarioseguidor.idSeguidor = tbusuario.idusuario WHERE tbusuarioseguidor.idUsuarioSeguidor = " . $notificacao['idUsuarioSeguidor'];
                            $consulta = $conexao->query($query);
                            $listaUsuarioNotif = $consulta->fetchAll();

                            foreach ($listaUsuarioNotif as $linhaUsuarioNotif) {
                                $loginUsuarioNotif = $linhaUsuarioNotif['loginUsuario'];
                                $idUsuarioNotif = $linhaUsuarioNotif['idUsuario'];
                            }
                            $fotoUsuarioNotif = $fotoUsuario->exibirFotoUsuario($idUsuarioNotif);
                        ?>
                            <div class="notificacao">
                                <div style="display: flex; gap: 1rem; align-items: center;">
                                    <img src="<?php echo $fotoUsuarioNotif ?>" class="fotoDePerfil">
                                    <a href="/petiti/<?php echo $loginUsuarioNotif ?>">
                                        <h4>@<?php echo $loginUsuarioNotif ?></h4>
                                    </a>
                                    <h4 class="text-muted">começou a seguir você.</h4>
                                    <h5 class="text-muted">Há <?php echo $diferencaFinal ?> </h5>
                                </div>

                                <?php

                                $verificarSeguidor = $usuarioSeguidor->verificarSeguidor($idUsuarioNotif, $id);
                                if ($verificarSeguidor['boolean'] == true) {
                                    $jsSeguidor = "true";
                                } else {
                                    $jsSeguidor = "false";
                                } ?>

                                <?php if ($verificarSeguidor['boolean'] == true) { ?>
                                    <input id="jsSeguidor" value="<?php echo $jsSeguidor ?>" type="hidden">

                                    <button value="<?php echo $idUsuarioNotif ?>" class="seguirNotif botaoUsuario<?php echo $idUsuarioNotif?> btn btn-primary">Seguir</button>
                                <?php } else { ?>
                                    <button value="<?php echo $idUsuarioNotif ?>" class="seguirNotif botaoUsuario<?php echo $idUsuarioNotif?> btn btn-secundary">Seguindo</button>
                                <?php } ?>
                            </div>
                        <?php } ?>


                        <?php if ($notificacao['tipoNotificacao'] == "Curtida") {
                            $idPubResultado = $curtidaPub->procurarPub($notificacao['idCurtidaPublicacao']);
                            $query = "SELECT loginUsuario, idUsuario FROM tbusuario INNER JOIN 
                            tbcurtidapublicacao ON tbcurtidapublicacao.idusuariocurtida = tbusuario.idusuario WHERE tbcurtidapublicacao.idcurtidapublicacao = " . $notificacao['idCurtidaPublicacao'];
                            $consulta = $conexao->query($query);
                            $listaUsuarioNotif = $consulta->fetchAll();

                            foreach ($listaUsuarioNotif as $linhaUsuarioNotif) {
                                $loginUsuarioNotif = $linhaUsuarioNotif['loginUsuario'];
                            }
                            $fotoUsuarioNotif = $fotoUsuario->exibirFotoUsuario($notificacao['idUsuarioCurtida']);

                            //

                            $urlNotif = "http://localhost/petiti/api/publicacao/" . $idPubResultado;
                            $jsonPubNotif = file_get_contents($urlNotif);
                            $dadosPubNotif = (array)json_decode($jsonPubNotif, true);
                            $foto = $dadosPubNotif[0]['caminhoFoto'];
                        ?>
                            <div class="notificacao">
                                <div style="display: flex; gap: 1rem; align-items: center;">
                                    <img src="<?php echo $fotoUsuarioNotif ?>" alt="" class="fotoDePerfil">
                                    <a href="/petiti/<?php echo $loginUsuarioNotif ?>">
                                        <h4>@<?php echo $loginUsuarioNotif ?></h4>
                                    </a>

                                    <h4 class="text-muted">curtiu sua postagem.</h4>
                                    <h5 class="text-muted">Há <?php echo $diferencaFinal ?></h5>
                                </div>

                                <img src="<?php echo $foto ?>" alt="" class="previewPostImage">
                            </div>
                        <?php } ?>

                    <?php } ?>



                </div>


            </div>
            <!-- fim do meio -->


            <div class="ladoDireito">
                <!-- posts de pets perdidos -->
                <div class="whiteBoxHolder postsPerdidosHolder">

                    <div class="heading tituloPetsPerdidos">
                        <h4>Ajude alguém a encontrar seu pet</h4>
                    </div>

                    <div class="postsPerdidos">
                        <div class="fotoDePerfil">
                            <img src="#" alt="">
                        </div>
                        <div class="infoPostPerdidos">
                            <h4>Minha cachorrinha fugiu de casa!</h4>
                            <h5 class="text-Muted">Há <span>3 meses</span> - <span>Localização: Centro de guaianases</span></h5>
                        </div>
                    </div>

                    <div class="postsPerdidos">
                        <div class="fotoDePerfil">
                            <img src="#" alt="">
                        </div>
                        <div class="infoPostPerdidos">
                            <h4>Minha cachorrinha fugiu de casa!</h4>
                            <h5 class="text-Muted">Há <span>3 meses</span> - <span>Localização: Centro de guaianases</span></h5>
                        </div>
                    </div>

                    <div class="postsPerdidos">
                        <div class="fotoDePerfil">
                            <img src="#" alt="">
                        </div>
                        <div class="infoPostPerdidos">
                            <h4>Minha cachorrinha fugiu de casa!</h4>
                            <h5 class="text-Muted">Há <span>3 meses</span> - <span>Localização: Centro de guaianases</span></h5>
                        </div>
                    </div>


                </div>
                <!-- fim de posts de pets perdidos -->

                <div class="categoriasEmAlta">
                    <div class="whiteBoxHolder ">
                        <div class="heading">
                            <h4>Categorias em alta</h4>
                        </div>

                        <div class="categoriasAltaGrid">

                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position1.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position5.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position2.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position6.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>



                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position3.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position7.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>


                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position4.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>



                            <div class="categorias">

                                <div class="Lugar">
                                    <div class="fotoDePerfil">
                                        <img src="/petiti/views/assets/img/position8.svg" alt="">
                                    </div>
                                    <div class="infoCategoria">
                                        <h4>tamandua</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- fim das categorias em alta -->


                <div class="sugestoes">
                    <h4>Sugestões para você</h4>

                    <div class="whiteBoxHolder">

                        <div class="flex-row">
                            <div class="fotoDePerfil">
                                <img src="#" alt="">
                            </div>

                            <div class="infoSugestoes">
                                <h4>nome de usuario</h4>
                                <h5 class="text-muted">@username</h5>
                            </div>
                        </div>

                        <button class="btn btn-primary">Seguir</button>
                    </div>

                    <div class="whiteBoxHolder">

                        <div class="flex-row">
                            <div class="fotoDePerfil">
                                <img src="#" alt="">
                            </div>

                            <div class="infoSugestoes">
                                <h4>nome de usuario</h4>
                                <h5 class="text-muted">@username</h5>
                            </div>
                        </div>

                        <button class="btn btn-primary">Seguir</button>
                    </div>

                    <div class="whiteBoxHolder">

                        <div class="flex-row">
                            <div class="fotoDePerfil">
                                <img src="#" alt="">
                            </div>

                            <div class="infoSugestoes">
                                <h4>nome de usuario</h4>
                                <h5 class="text-muted">@username</h5>
                            </div>
                        </div>

                        <button class="btn btn-primary">Seguir</button>
                    </div>


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