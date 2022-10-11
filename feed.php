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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="assets/styles/stylesheet.css">
    <link rel="stylesheet" href="assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="assets/images/logo-icon.svg">

    <!--script-->

    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="assets/libs/croppie/croppie.js"></script>
    <script src="assets/js/jquery-scripts.js"></script>
    <script src="assets/js/script.js"></script>


</head>

<body id="bodyFeed">

    <main class="holderFeed">
        <section class="leftBarHolder">
            <div class="leftBar">


                <div class="leftBarMenu">

                    <div class="innerLeftBarMenu">

                        <div style="display: flex; flex-direction: column;">
                            <img src="./assets/images/logo_principal.svg" class="imgLogoFeed">
                            <a href="#">Home</a>
                            <a href="#">Animais perdidos</a>
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
        </section>

        <section class="rightBarHolder">

        </section>
    </main>

    
    <!-- Modal Post -->
    <section id="post">

        <div id="modal-foto-post" class="modal">
            <p>Arraste fotos, vídeos ou gif aqui</p>
            <input type="file" accept="image/*" id="flFoto">
        </div>

        <div id="modal-recortar-foto" class="modal">
            <p>
                <a id="continuar-post" href="#criar-post" rel="modal:open">Continuar</a>
            </p>
            <div id="upload-demo"></div>
        </div>

        <div id="criar-post" class="modal">
            <div id="preview-crop-image">

            </div>
        </div>
    </section>
</body>

</html>