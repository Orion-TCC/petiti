<!DOCTYPE php>
<html lang="pt-br">
<?php
include_once("sentinela-cadastro.php");
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
    <script src="/petiti/views/assets/js/script.js"></script>

<body>
    <main class="container-content">
        <section id="formularioPet">
            <div class="holderFormularioPet">

                <div class="formulario">

                    <div class="tituloFormHolder">
                        <span>
                            Vamos conhecer seu pet!
                        </span>
                    </div>

                    <div class="subTituloFormHolderUsuario">
                        <span>
                            Insira os dados dele abaixo:
                        </span>
                    </div>

                    <div class="formularioHolder ">
                        <form class="formElementsHolder" action="/petiti/api/pet/add" method="POST" enctype="multipart/form-data">

                            <label class="formText">Nome</label>
                            <input class="formInput" placeholder="Insira o nome" type="text" name="txtNomePet" required>

                            <label class="formText">Espécie</label>
                            <select name="slEspecie" id="slEspecie" required class="SelectEspecie">
                                <option style="color: #000000; font-family: 'Raleway Bold';" value="1">Cachorro</option>
                                <option style="color: #000000; font-family: 'Raleway Bold';" value="2">Gato</option>
                                <option style="color: #000000; font-family: 'Raleway Bold';" value="3">Roedor</option>
                                <option style="color: #000000; font-family: 'Raleway Bold';" value="4">Ave</option>
                                <option style="color: #000000; font-family: 'Raleway Bold';" value="5">Exótico</option>
                            </select>
                            <label class="formText">Raça</label>
                            <input class="formInput" placeholder="Insira a raça" type=" text" name="txtRacaPet" required>
                            <label class="formText">Idade</label>
                            <div class="idadePet">
                                <input min="1" class="formInput" placeholder="Insira a idade" type="number" name="txtIdadePet" id="txtIdadePet" required>
                                <select class="SelectDiaMesAno" name="slIdade" id="slIdade" required>
                                    <option value="n" selected disabled>Escolha</option>
                                    <option value="d">Dia (Dias)</option>
                                    <option value="m">Mês (Meses)</option>
                                    <option value="y">Ano(s)</option>
                                </select>
                            </div>
                            <button class="formSubmit" type="submit">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="/petiti/views/assets/js/script-jquery.js"></script>

</html>