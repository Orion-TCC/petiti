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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="../../../assets/js/script.js" async></script>
    <script src="../../../assets/js/cep.js" async></script>
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

                    <form action="controllers/controller-foto.php" method="post" enctype="multipart/form-data" class="formElementsHolder">

                        <label class="subTituloFormFoto">
                            Foto
                        </label>

                        <label class="formLabelFoto" id="inputTag">
                            <input class="inputFormFoto" type="file" name="flFoto">
                            Anexar foto dos meus arquivos
                        </label>

                        <label class="formTextFotoInput" id="imageName">
                            Nenhum arquivo selecionado
                        </label>


                        <div class="formTextFotoEmpresa">
                            <span>*Será possível alterar quando sua conta estiver feita.</span>
                        </div>

                        <input class="formInputFoto" type="submit" value="Continuar">
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

</html>