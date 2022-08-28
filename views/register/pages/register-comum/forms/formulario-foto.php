<!DOCTYPE php>
<html lang="pt-br">
    
<head>
    <!-- HTML base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="../../../../css/style.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="../../../../img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="../../../../js/script.js" async></script>
</head>

<body>
    <main class="container-content">
        <section id="formularioFoto">
            <div class="holderFormularioFoto">
                <div class="formulario">
                    <div class="imgSetaVoltarHolder">
                    <a href="../forms/formulario-usuario.php"> <img class="imgSetaVoltar" src="../../../../img/seta - voltar.svg" alt=""></a>
                    </div>

                    <div class="tituloFormFoto">
                        <span>Deixe seu pefil mais a sua cara!</span>
                    </div>
                   
                    <form enctype="multipart/form-data" action="controllers/controller-foto.php" method="POST" class="formElementsHolder">
                           
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

                            <div class="EHolder">
                                    <div class="line"></div>
                                    <span>E</span>
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


