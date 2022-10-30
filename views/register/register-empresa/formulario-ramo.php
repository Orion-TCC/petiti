<html>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>

    <script src="/petiti/views/assets/js/cep.js"></script>
</head>


<body>
    <main class="container-content">
        <section id="formularioRamoEmpresa">
            <div class="holderFormularioFotoEmpresa">
                <div class="formulario">
                <a class="setaVoltar" href="foto-empresa"><img src="/petiti/views/assets/img/seta - voltar.svg" alt=""></a>
                    <div class="tituloFormHolder">
                        <span>
                            Qual o ramo da sua empresa?
                        </span>
                    </div>

                    <div class="subTituloFormHolderUsuarioEmpresa">
                        <span>
                            Escolha o ramo abaixo:
                        </span>
                    </div>

                    <?php
                    require_once("/xampp/htdocs/petiti/api/classes/TipoUsuario.php");
                    $tipoUsuario = new TipoUsuario();
                    $listaTipos = $tipoUsuario->listar();
                    ?>
            <div class="formElementsHolderflexivel">
                    <form action="api/usuario/cadastro/update/ramo" method="post">
                        <input type="hidden" name="campo" value="ramo">
                        <select name="slRamo" id="slRamo" class="SelectRamo">
                            <option value="0" disabled selected>Escolha</option>
                            <?php
                            foreach ($listaTipos as $linha) {
                                if ($linha['idTipoUsuario'] > 1) { ?>
                                    <option style="color: #000000;" value="<?php echo $linha['idTipoUsuario'] ?>"><?php echo $linha['tipoUsuario'] ?></option>
                                <?php } ?>
                            <?php }
                            ?>
                        </select>
                        <div class="formTextRamo">
                            <span>Você poderá inserir seus serviços/produtos assim que você finalizar o cadastro e logar em sua conta, indo para a home da nossa rede social.</span>
                        </div>

                        <input class="formInputRamo" type="submit" value="Continuar">
                    </form>
            </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>