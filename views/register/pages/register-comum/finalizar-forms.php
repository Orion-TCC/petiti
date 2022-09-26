<!DOCTYPE php>
<html lang="pt-br">
<?php
@session_start();
unset($_SESSION['id-cadastro']);
unset($_SESSION['id-cadastro-pet']);
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
</head>

<body>
    <main class="container-content">
        <section id="formularioFoto">
            <div class="holderFormularioFotoPet">
                <div class="formulario">

                    <div class="tituloFormHolder2">
                        <span>Uau! Finalmente. Aproveite!</span>
                    </div>
                    <div class="formTextFinalizarForms">
                        <span>Pelo visto está tudo completo agora, finalize seu cadastro e explore a <span style="color: #3837A1;">pet iti</span> e tudo que nós temos a oferecer! Interaja com petlovers igual a você</span>
                    </div>
                    <div>
                        <img src="../..//petiti/views/assets/img/calopsita.svg" alt="">
                    </div>
                    <div>
                        <a class="botaoFinalizar" href="../../../login/login.php">Finalizar</a>
                    </div>
                    <div>
                        <img class="logoPrincipalFinalizarForm" src="../..//petiti/views/assets/img/logo-principal-achatada.svg" alt="">
                    </div>
                </div>
            </div>

        </section>
    </main>
</body>

</html>