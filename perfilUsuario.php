<?php
@session_start();
require('api/classes/curtidaPublicacao.php');
$curtidaPub = new curtidaPublicacao();
date_default_timezone_set('America/Sao_Paulo');
include_once("sentinela.php");
$idUsuarioCurtida = $_SESSION['id'];
?>
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
    <link rel="stylesheet" href="assets/css/feed-style.css">
    <link rel="stylesheet" href="assets/libs/croppie/croppie.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    
    <!--- iconscout icon --->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <!-- título da pág e icone (logo) -->
    <title>Pet iti - Feed</title>
    <link rel="icon" href="assets/images/logo-icon.svg">

    <!--script-->

    <script src="https://kit.fontawesome.com/e08c13fee8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <script src="assets/libs/croppie/croppie.js"></script>
    <script src="assets/js/jquery-scripts.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/funcs.js"></script>
</head>

<body class="feed">
    
    <nav class="feed">
            <div class="container">
                <h2 class="logo">
                 <img src="./assets/images/logo_principal.svg">
                </h2>
                <div class="caixa-de-busca">
                  <i class="uil uil-search"></i>
                  <input type="search" placeholder="Pesquisar">
                </div>

                <div class="opcoes">
                    <label for="abrir-opcoes"><i class="uil uil-setting"></i></label>
                    <div class="fotoDePerfil">
                        <img src="<?php echo $_SESSION['foto']; ?>"  alt="">
                    </div>
                </div>
            </div>
    </nav>

    <main class="feed">
        <div class="container">

                            <!-- LADO ESQUERDO -->
            <div class="ladoEsquerdo">

                <a href="perfilUsuario.php" class="perfilAtivo">
                    <div class="fotoDePerfil">
                      <img src="<?php echo $_SESSION['foto']; ?>"  alt="">
                    </div>
                    <div class="handle">
                        <h4><?php echo $_SESSION['nome']; ?></h4>
                        <p class="text-muted">
                        <?php echo "@" . $_SESSION['login']; ?>
                        </p>
                    </div>
                </a>
                            <!-- SIDEBAR LADO ESQUERDO -->

                <div class="sidebar">
                    <a href="#" class="menu-item">
                        <span><i class="uil uil-house-user"></i> </span> <h3>Home</h3>
                    </a>  

                    <a href="#" class="menu-item">
                        <span><i class="uil uil-heart-break"></i></span>  <h3>Animais perdidos</h3>
                    </a> 
                    
                    <a href="#" class="menu-item">
                        <span><i class="uil uil-archive"></i> </span>  <h3>Animais em doação</h3>
                    </a> 


                    <a href="#" class="menu-item">
                        <span><i class="uil uil-bell"></i> </span>  <h3>Notificações</h3>
                    </a> 
                       
                    <a href="#" class="menu-item">
                        <span><i class="uil uil-envelope"></i> </span>  <h3>Mensagens</h3>
                    </a> 
                         
                    <a href="#" class="menu-item">
                        <span><i class="uil uil-shopping-bag"></i> </span>  <h3>Produtos e Serviços</h3>
                    </a> 
                    
                    <a href="#" class="menu-item">
                        <span><i class="uil uil-coffee"></i> </span>  <h3>Para Você</h3>
                    </a>
                </div>

                <!-- Botao de criar post -->
                <button class="btn btn-primary">
                        <p>
                            <a href="#modal-foto-post" rel="modal:open">Criar um Post</a>
                        </p>
                </button>

            </div>
                <!-- FIM DO LADO ESQUERDO -->

            <div class="Meio">
                <div class="userArea">
                    <div class="userHandle">

                        <div class="fotoDePerfil">
                            <img src="#" alt="">
                        </div>

                        <div class="userInfo">
                            <div>
                                <h4>/nome de usuario</h4>
                                <button class="btn btn-primary">Editar perfil</button>
                            </div>

                            <div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- fim do meio -->

        </div>
    </main>

</body>
</html>




<!-- <button class="seguir" value="1">seguir</button> -->