<!DOCTYPE php>
<html lang="pt-br">
<?php
include_once("sentinela-cadastro.php");
?>

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

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="/petiti/views/assets/js/script.js"></script>
    <script src="/petiti/views/assets/js/cep.js"></script>
</head>

<body>
    <main class="container-content">
        <section id="formularioUsuarioEmpresa">
            <div class="holderFormularioUsuarioEmpresa">

                <div class="formulario">


                    <div class="tituloFormHolder">

                        <span>
                            Conte um pouco sobre você...
                        </span>
                    </div>

                    <div class="subTituloFormHolderUsuarioEmpresa">
                        <span>
                            Insira seus dados de acesso abaixo:
                        </span>
                    </div>

                    <div class="formularioHolder">
                        <form class="formElementsHolder" action="/petiti/api/usuario/endereco/add" method="post">

                            <label class="formText">Nome da empresa</label>
                            <input class="formInput" placeholder="Insira um nome" type="text" name="txtNomeEmpresa" id="txtNomeEmpresa" required autofocus>

                            <label class="formText">CEP</label>
                            <input class="formInput" placeholder="Insira seu CEP" type="text" onblur="pesquisacep(this.value)" name="txtCep" id="cep" required minlength="2">
                            <span class="textoAviso">*Ao inserir o CEP, o outro campo será preenchido automaticamente</span>

                            <label class="formText">Endereço</label>
                            <input class="formInput" placeholder="Rua Feliciano de Mendonça" type="text" name="txtEnderecoEmpresa" id="rua" required minlength="4">


                            <label class="formText">Complemento</label>
                            <input class="formInput" placeholder="Bloco B" type="text" name="txtComplementoEmpresa" id="txtComplementoEmpresa" minlength="1">



                            <label class="formText">Número</label>
                            <input class="formInput" placeholder="Exemplo: 290" type="text" name="txtNumeroEmpresa" id="txtNumeroEmpresa" required minlength="1">

                            <div class="CidadeEUFHolder">
                                <div style="width: 380px;">
                                    <label class="formText">Cidade</label>
                                    <input class="formInput" placeholder="São Paulo" type="text" name="txtCidadeEmpresa" id="cidade" required minlength="6">
                                </div>

                                <div style="width: 160px; margin-left: 20px;">
                                    <label class="formText">UF</label>
                                    <input class="formInput" placeholder="SP" type="text" name="txtUfEmpresa" id="uf" required minlength="6">
                                </div>
                            </div>
                            <button class="formSubmit" type="submit">Continuar</button>
                        </form>
                    </div>


                </div>
            </div>
        </section>
    </main>
</body>

</html>