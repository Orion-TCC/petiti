<html>

<head>
    <?php
    include_once("sentinela-cadastro.php");
    ?>
    <!-- HTML base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css">
    <link rel="stylesheet" href="/petiti/assets/libs/croppie/croppie.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>

    <script src="/petiti/views/assets/js/cep.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>

    <script async src="/petiti/views/assets/js/script-jquery-foto.js"></script>


</head>



<body>
    <main class="container-content">
        <section id="formularioFotoEmpresa">
            <div class="holderFormularioFotoEmpresa">
                <div class="formulario">

                    <div class="tituloFormHolder">
                        <span>
                            Identificação da empresa
                        </span>
                    </div>

                    <div class="formElementsHolder">

                        <label class="subTituloFormFoto">
                            Foto
                        </label>

                        <label class="formLabelFoto" id="inputTag">
                            <input accept=".jpg, .png" class="inputFormFoto" type="file" id="flFoto" name="flFoto">
                            <input id="baseFoto" type="hidden" name="baseFoto" value="">
                            Anexar foto dos meus arquivos
                        </label>

                        <label class="previewFormFoto" id="imagePreview">
                            <img class="previewFoto" id="preview" src="/petiti/private-user/fotos-perfil/padrao.png" />
                        </label>

                        <label class="formTextFotoInput" id="imageName">
                            Nenhum arquivo selecionado
                        </label>


                        <div class="formTextFotoEmpresa">
                            <span>*Será possível alterar quando sua conta estiver feita.</span>
                        </div>

                        <a id="enviarFoto" href="ramo-empresa" class="formInputFoto"> Continuar</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div id="modal-recortar-foto" class="modal">
        <a href="#close-modal" rel="modal:close">
            <label rel="modal:close" id="continuar-crop-foto" style="cursor:pointer;">Confirmar</label>
        </a>
        <div id="upload-demo"></div>
    </div>
</body>

</html>