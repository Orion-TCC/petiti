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
    <link rel="stylesheet" href="/petiti/assets/css/style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <link async rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link async rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link async rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link async rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
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
    <script src="/petiti/assets/js/funcs.js"></script>



</head>

<body id="bodyFeed">

    <main class="holderFeed">
        <section class="leftBarHolder">
            <div class="leftBar">


                <div class="leftBarMenu">

                    <div class="innerLeftBarMenu">

                        <div style="display: flex; flex-direction: column;">
                            <img src="/petiti/assets/images/logo_principal.svg" class="imgLogoFeed">
                            <a href="#" class="enfase ">Home</a>
                            <a href="petiti/animaisPerdidos">Animais perdidos</a>
                            <a href="#">Animais em doação</a>
                            <a href="#">Notificações</a>
                            <a href="#">Mensagens</a>
                            <a href="#">Produto e serviços</a>

                            <hr class="line">
                            <button class="botaoCPost">
                                <p>
                                    <a href="#modal-foto-post" rel="modal:open">Criar um Post</a>
                                </p>
                            </button>


                        </div>
                    </div>

                    <div class="userElementos">

                        <img class="imagemUser" src="<?php echo $_SESSION['foto']; ?>" alt="">

                        <div style="display: flex; flex-direction: column; margin-left: 10px;">

                            <span class="textNomeUsuario"><?php echo $_SESSION['nome']; ?></span>

                            <span class="textTagUsuario"> <?php echo "@" . $_SESSION['login']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="postsHolder">
            <div class="publicacoesHolder">
                <?php
                $url = "http://localhost/petiti/api/publicacoes";

                $json = file_get_contents($url);
                $dados = (array)json_decode($json, true);
                $contagem = count($dados['publicacoes']);


                for ($i = 0; $i < $contagem; $i++) {


                    $id =  $dados['publicacoes'][$i]['id'];
                    $nome = $dados['publicacoes'][$i]['nome'];
                    $login = $dados['publicacoes'][$i]['login'];
                    $foto = $dados['publicacoes'][$i]['caminhoFoto'];
                    $idUsuario = $dados['publicacoes'][$i]['idUsuario'];
                    $data = $dados['publicacoes'][$i]['data'];
                    $texto = $dados['publicacoes'][$i]['texto'];
                    $itimalias = $dados['publicacoes'][$i]['itimalias'];
                    $fotoUsuario = $dados['publicacoes'][$i]['fotoUsuario'];

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
                    <div id="post" class="post">

                        <div class="elementosUserPost">

                            <img class="imagemUser" src="<?php echo $fotoUsuario ?>" alt="">
                            <div>
                                <p class="login"><?php echo $login ?></p>
                                <span class="local">Local (se botar)</span>
                            </div>

                        </div>

                        <img class="foto" src="<?php echo $foto ?>">


                        <div class="holderPost">
                            <?php
                            $verificaCurtida = $curtidaPub->verificarCurtida($id, $idUsuarioCurtida);
                            if ($verificaCurtida['boolean'] == false) { ?>
                                <input checked class="curtir" value="<?php echo $id ?>" type="checkbox">
                            <?php } else { ?>
                                <!-- curtido -->
                                <input class="curtir" value="<?php echo $id ?>" type="checkbox">
                                <!-- nao curtido  -->
                            <?php }
                            ?>
                            <button value="<?php echo $id ?>" class="comentar" value="">Comentar</button>
                        </div>

                        <p class="itimaliasPost" id="itimaliasPost<?php echo $id ?>"><?php echo $itimalias ?> itimalias</p>

                        <div class="holderPost">
                            <p class="login"> <?php echo $login ?> <span class="texto"><?php echo $texto ?></span> </p>
                        </div>



                        <p class="dataDif">Há <?php echo $diferencaFinal ?></p>

                        <div class="comentarioArea">
                            <textarea oninput="auto_grow(this)" placeholder="Adicione um comentário!" maxlength="200" name="txtComentar<?php echo $id ?>" id="txtComentar<?php echo $id ?>"></textarea>
                        </div>

                    </div>
                <?php }
                ?>
            </div>
        </section>

        <section class="rightBarHolder">

        </section>
    </main>

    <!-- Modal Post -->
    <section id="post">

        <div id="modal-foto-post" class="modal">
            <div class="modal-foto-post">
                <div class="tituloModalPost">Criar um post</div>
                <div class="inputArea">
                    <img src="./assets/images/selectFotoIlustracao.png">
                    <span class="textPadrao">Arraste fotos, vídeos ou gifs aqui</span>
                    <label class="inputButtonEstilo">
                        <input class="inputForm" type="file" accept="image/*" id="flFoto">
                        <span>Selecionar no computador</span>
                        <label>
                </div>
            </div>

        </div>

        <script>
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
        </script>

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
                                    <img class="imagemUser" src="<?php echo $_SESSION['foto']; ?>" alt="">
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
                                <span class="material-symbols-outlined">location_on</span>
                            </div>




                            <div class="parte3CriarPost">

                                <span id="botaoShowHide" class="botaoShowHide" onclick="showHideElement()">
                                    <label for="txtCategoria">Categoria</label>
                                    <span id="expandMoreIcon" class="material-symbols-outlined">expand_more</span>
                                    <span id="expandLessIcon" class="material-symbols-outlined" style="display: none;">expand_less</span>
                                </span>

                                <div id="categoriasHolder">

                                    <span class="textPlaceholder">
                                        Insira categorias no seu post e você irá alcançar mais engajamento e até mesmo ajudar a filtrar a “Para você” de outros petlovers/petmigos.
                                    </span>

                                    <div style="display: grid; grid-template-columns: repeat(10, 1fr); width: 100%;">
                                        <input type="text" name="txtCategoria" id="txtCategoria" placeholder="Ex: Lhama">
                                        <p id="submitCategoria"><span id="addIcon" class="material-symbols-outlined">add</span></p>
                                    </div>

                                    <div id="categoriasChecksHolder" style="display: grid; grid-template-columns: repeat(9, 1fr); width: 100%; gap: 10px; overflow-y: auto; height: 100px;">
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
</body>

</html>