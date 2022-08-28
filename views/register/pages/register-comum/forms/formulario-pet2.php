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
<body>
    <main class="container-content">
        <section id="formularioPet">
            <div class="holderFormularioPet">
              
            <div class="formulario">

                <div class="imgSetaVoltarHolder">
                   <a href="formulario-pet1.php"> <img class="imgSetaVoltar" src="../../../../img/seta - voltar.svg" alt=""></a>
                </div>

                <div class="tituloFormHolder">
                    <span>
                    Vamos conhecer seu pet!
                    </span>
                </div>

                <div class="subTituloFormHolder">
                    <span>
                        Insira os dados dele abaixo:
                    </span>
                </div>
                

                <div class="formularioHolder ">
                    <form class="formElementsHolder" action="controllers/controller-pet.php" method="POST" enctype="multipart/form-data">

                        <label class="formText">Nome</label>
                    <input class="formInput" placeholder="Insira o nome"type="text" name="txtNomePet" required>

                        <label class="formText">Espécie</label>
                    <input class="formInput" placeholder="Insira a espécie"type="text" name="txtEspeciePet" required>

                        <label class="formText">Raça</label>
                    <input class="formInput" placeholder="Insira a raça"type=" text" name="txtRacaPet"  required>

                        <label class="formText">Idade</label>
                    <input class="formInput" placeholder="Insira a idade"type="text" name="txtIdadePet"  required>

                         <button class="formSubmit" type="submit">Continuar</button>
                           
                    </form>
                </div>


            </div>    
         </div>
        </section>
    </main>
</body>

</html>