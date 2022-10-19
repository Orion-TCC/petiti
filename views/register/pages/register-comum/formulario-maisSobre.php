<!DOCTYPE php>
<html lang="pt-br">
<?php
@session_start();
include_once("sentinela-cadastro.php");
$_SESSION['tipo-usuario'] = "usuario";

?>

<head>
    <!-- HTML base -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A Orion é uma empresa especializada em softwares para empresas de pequeno e médio porte.">

    <!-- styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/petiti/views/assets/css/style.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="/petiti/assets/libs/croppie/croppie.js"></script>

    <script async src="/petiti/views/assets/js/script-jquery-foto.js"></script>

    <script async src="/petiti/views/assets/js/script-jquery.js"></script>

</head>

<body>
    <main class="container-content">
        <section id="formularioMaisSobre">
            <div class="holderMaisSobre">
                <div class="formulario">
                    <a class="setaVoltar" href="cadastro-usuario"><img src="/petiti/views/assets/img/seta - voltar.svg" alt=""></a>
                    <div class="tituloFormHolder">
                        <span>
                            Conte um pouco sobre você...
                        </span>
                    </div>
                    <div class="subTituloFormHolderUsuario">
                        <span>
                            Insira seus dados pessoais abaixo:
                        </span>
                    </div>
                    <div class="formularioHolder ">
                        <form class="formElementsHolder" action="api/usuario/info" method="post">

                            <label class="formText">Nome</label>
                            <input class="formInput" placeholder="Insira seu nome ou apelido" type="text" name="txNome" id="txNome" required autofocus>



                            <label class="formText">Biografia</label>
                            <textarea class="formInput" name="txBio" id="txBio" cols="30" rows="10" placeholder="Escreva algo sobre você, curiosidades talvez..."></textarea>


                            <label class="formText">Localização</label>
                            <input  class="formInput" placeholder="Insira sua localização" type="text" name="txLocal" id="txLocal" required >
                        
                             


                            <label class="formText">Site</label>
                            <input class="formInput" placeholder="Insira uma URL" type="text" name="txSite" id="txSite" required minlength="6">



                            <button id="submitUsuario" class="formSubmit" type="submit">Continuar</button>


                        </form>
                    </div>



                </div>
            </div>
        </section>
    </main>
</body>