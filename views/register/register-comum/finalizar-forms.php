<!DOCTYPE php>
<html lang="pt-br">
<?php
@session_start();
$id = $_SESSION['id-cadastro'];
for ($a=0; $a < 2; $a++) { 
    $urlPets = "http://localhost/petiti/api/usuario/$id/pets";
}
$jsonPets = file_get_contents($urlPets);

$dadosPets = (array) json_decode($jsonPets, true);

$contagemPets = count($dadosPets['pets']);
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
    <link rel="stylesheet" href="/petiti/assets/css/feed-style.css">

    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - A rede social para petlovers</title>
    <link rel="icon" href="/petiti/views/assets/img/logo-icon.svg">

    <!--script-->
    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
 
</head>

<body>
    <main class="container-content">
        <section id="paginafinal">
            <div class="holderFormularioFotoPet">
                <?php if ($contagemPets < 1) { ?>
                    <div class="formulario">
                        <div class="formElementsHolderflexivel">
                            <div class="tituloFormHolder2">
                                <span>Uau! Finalmente. Aproveite!</span>
                            </div>
                            <div class="formTextFinalizarForms">
                                <span> Caso esteja tudo certo podemos explorar a <span style="color: #3837A1;">pet iti</span> e interagir com petlovers igual a você!
                                    Mas se desejar, você pode fazer o cadastro de outro pet agora.
                                </span>
                            </div>
                            <div>
                                <img src="/petiti/views/assets/img/calopsita.svg" alt="" style="margin-bottom: 10px;">
                            </div>
                            <div>
                                <a class="botaoFinalizar" href="/petiti/login">Finalizar</a>
                                <a class="botaoOutroCadastro" href="/petiti/formulario-pet">Fazer outro cadastro</a>
                            </div>

                        </div>
                    </div>
                <?php } else { ?>

                    <div class="formulario">
                        <div class="formElementsHolderflexivel">
                            <div class="tituloFormHolder2">
                                <span>Essas são as contas dos seus pets</span>
                            </div>

                            <div class="petsPerfilHolder">
                                <?php for ($p = 0; $p < $contagemPets; $p++) { ?>
                                    <div class="petUser flex-row">

                                        <div class="fotoDePerfil">
                                            <img src="<?php echo $dadosPets['pets'][$p]['caminhoFotoPet'] ?>" alt="">
                                        </div>

                                        <div class="flex-col nomeEUser">
                                            <span><?php echo $dadosPets['pets'][$p]['nomePet'] ?></span>
                                            <span class="text-muted"> @<?php echo $dadosPets['pets'][$p]['usuarioPet'] ?></span>
                                        </div>
                                        <a href="/petiti/api/excluir-pet-cadastro/<?php echo $dadosPets['pets'][$p]['idPet'] ?>">
                                            <i class="uil uil-times-circle"></i>
                                        </a>
                                    </div>
                                <?php    } ?>
                            </div>


                            <div>
                                <a class="botaoFinalizar" href="/petiti/login">Finalizar</a>
                                <a class="botaoOutroCadastro" href="/petiti/formulario-pet">Fazer outro cadastro</a>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>

        </section>
    </main>
</body>

</html>