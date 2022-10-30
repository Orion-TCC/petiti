<?php
@session_start();
require_once('../../api/classes/curtidaPublicacao.php');
$curtidaPub = new curtidaPublicacao();
date_default_timezone_set('America/Sao_Paulo');
include_once("../../sentinela.php");
$idUsuarioCurtida = $_SESSION['id'];
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
            <h2 class="logo">
                <img src="/petiti/assets/images/logo_principal.svg">
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

                <a href="/petiti/meu-perfil" class="perfil">
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
                    <a href="#" class="menu-item ativo">
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
                <!-- ads/servicos(passar a limpo depois) -->
                <span class="adTitulo">Veja o que estão anunciando!</span>
                <div class="ads">
                    <?php
                    $url = "http://localhost/petiti/api/publicacoes/impulsionadas";

                    $jsonAds = file_get_contents($url);
                    $dadosAds = (array)json_decode($jsonAds, true);
                    $contagemAds = count($dadosAds['publicacoes']);
                    for ($i = 0; $i < $contagemAds; $i++) {


                        $nomeAds = $dadosAds['publicacoes'][$i]['nome'];
                        $loginAds = $dadosAds['publicacoes'][$i]['login'];
                        $fotoAds = $dadosAds['publicacoes'][$i]['caminhoFoto'];
                        $idUsuario = $dadosAds['publicacoes'][$i]['idUsuario'];
                        $fotoUsuarioAds = $dadosAds['publicacoes'][$i]['fotoUsuario'];
                    ?>
                        <div class="ad" style="background: url(<?php echo $fotoAds ?>) no-repeat center center/cover">
                            <div class="adHandler">
                                <div class="fotoDePerfil">
                                    <img src="<?php echo $fotoUsuarioAds; ?>" alt="">
                                </div>
                                <p class="name">
                                    <?php echo $loginAds; ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <div class="criarPost">
                    <img src="assets/images/Lontrinhas.svg" alt="">
                    <div class="faixaPost">
                        <h3>Crie um post anexando uma foto, gif ou video!</h3>
                        <h3 class="text-muted">Compartilhe seu bichinho dormindo...</h3>
                        <button class="btn btn-primary">
                            <p>
                                <a href="#modal-foto-post" rel="modal:open">Postar</a>
                            </p>
                        </button>
                    </div>
                </div>
                <!-- fim da parte de ad -->

                <div class="feeds">
                    <?php
                    $url = "http://localhost/petiti/api/publicacoes";


                    $json = file_get_contents($url);
                    $dados = (array)json_decode($json, true);
                    $contagem = count($dados['publicacoes']);

                    for ($i = 0; $i < $contagem; $i++) {
                        $id =  $dados['publicacoes'][$i]['id'];

                        $urlComentarios = "http://localhost/petiti/api/comentarios/" . $id;

                        $jsonComentarios = file_get_contents($urlComentarios);

                        $dadosComentarios = (array)json_decode($jsonComentarios, true);
                        $qtdComentarios = $dadosComentarios[0]['qtd'];

                        $nome = $dados['publicacoes'][$i]['nome'];
                        $login = $dados['publicacoes'][$i]['login'];
                        $foto = $dados['publicacoes'][$i]['caminhoFoto'];
                        $idUsuario = $dados['publicacoes'][$i]['idUsuario'];
                        $data = $dados['publicacoes'][$i]['data'];
                        $texto = $dados['publicacoes'][$i]['texto'];
                        $itimalias = $dados['publicacoes'][$i]['itimalias'];
                        $fotoUsuario = $dados['publicacoes'][$i]['fotoUsuario'];
                        $local =  $dados['publicacoes'][$i]['local'];
                        $hoje = new DateTime();
                        $dataPost = new DateTime($data);
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

                        <div class="feed">
                            <div class="head">
                                <div class="usuario">
                                    <div class="fotoDePerfil">
                                        <img src="<?php echo $fotoUsuario; ?>" alt="">
                                    </div>
                                    <div class="info">
                                        <h3><?php echo $nome ?></h3>
                                        <small><?php echo $local ?> - há <?php echo $diferencaFinal ?></small>
                                    </div>

                                </div>
                                <span class="edit"><i class="uil uil-ellipsis-v"></i></span>
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
                                    
                                    <button class="comentar"></button>

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
                               <span class="text-bold"> <?php echo $login; ?></span>  <span class="text-muted"><?php echo $texto ?></span>
                            </div>

                            <div class="comments text-muted"></div>

                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <!-- fim do meio -->


            <div class="ladoDireito">
                <!-- posts de pets perdidos -->
                <div class="whiteBoxHolder">
                    <div class="heading">
                        <h4>Ajude alguém a encontrar seu pet</h4>
                    </div>

                    <div class="postsPerdidos">
                        <div class="fotoDePerfil">
                            <img src="<?php echo $_SESSION['foto']; ?>" alt="">
                        </div>
                        <div class="infoPostPerdidos">
                            <h4>Minha cachorrinha fugiu de casa!</h4>
                            <h5 class="text-Muted">Há <span>3 meses</span> - <span>Localização: Centro de guaianases</span></h5>
                        </div>
                    </div>
                </div>
                <!-- fim de posts de pets perdidos -->

                <div class="categoriasEmAlta">
                    <div class="whiteBoxHolder">
                        <div class="heading">
                            <h4>Categorias em alta</h4>
                        </div>

                        <div class="categorias">

                            <div class="Lugar">
                                <div class="fotoDePerfil">
                                    <img src="/petiti/assets/images/caixa.svg" alt="">
                                </div>
                                <div class="infoCategoria">
                                    <h4>tamandua</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim das categorias em alta -->


                <div class="sugestoes">
                    <h4>Sugestões para você</h4>

                    <div class="whiteBoxHolder">
                        <div class="fotoDePerfil">
                            <img src="#" alt="">
                        </div>

                        <div class="infoSugestoes">
                            <h4>nome de usuario</h4>
                            <h5 class="text-muted">@username</h5>
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


                                <textarea name="txtLegendaPub" placeholder="Escreva uma legenda para sua foto!" maxlength="200"></textarea>

                                <input type="hidden" name="categoriasValue" id="categoriasValue" value="categorias">

                                <input type="hidden" name="baseFoto" id="baseFoto">


                                <div class="letraCont">
                                    <span>0</span>
                                    <span>/200</span>
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
                                                <input class="checkbox" type="checkbox" name="categorias[]" id="<?php $dadosCategoria['categorias'][$i]['idCategoria'] ?>" value="<?php echo $dadosCategoria['categorias'][$i]['categoria']; ?>">
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
        <!-- fim Modals -->

    </main>

</body>

</html>