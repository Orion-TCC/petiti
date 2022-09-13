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
    <link rel="stylesheet" href="../../../assets/css/style.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="../../../assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="../../../assets/js/script.js" async></script>
</head>

<body>
    <main class="container-content">
        <section id="formularioFoto">
            <div class="holderFormularioFoto">
                <div class="formulario">

                    <div class="tituloFormHolder">
                        <span>
                            Deixe seu pefil mais a sua cara!
                        </span>
                    </div>

                    <form enctype="multipart/form-data" action="controllers/controller-foto.php" method="POST" class="formElementsHolder">

                        <label class="subTituloFormFoto">
                            Foto
                        </label>

                        <label class="formLabelFoto" id="inputTag">
                            <input class="inputFormFoto" type="file" name="flFoto" onchange="preview()">
                            Anexar foto dos meus arquivos
                        </label>

                        <label class="previewFormFoto" id="imagePreview">
                            <img class="previewFoto" id="frame" src="../../../../private-user/fotos-perfil/padrao.png" width="150px" height="150px" />
                        </label>

                        <label class="formTextFotoInput" id="imageName">
                            Nenhum arquivo selecionado
                        </label>

                        <div class="EHolder">
                            <div class="line"></div>
                            <span style="font-family:'Raleway Bold';">E</span>
                            <div class="line"></div>
                        </div>

                        <div class="formTextFoto">
                            <span>Caso não tenha escolhido uma foto, você pode fazer isso depois. E, caso você tenha anexado uma foto e não tenha gostado muito, será possível alterar quando sua conta estiver feita.</span>
                        </div>

                        <input class="formInputFoto" type="submit" value="Continuar">
                    </form>
                </div>
            </div>

        </section>
    </main>